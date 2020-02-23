<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
// use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use Symfony\Component\DomCrawler\Crawler;
// use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class DashboardController extends Controller
{
    /**
     * Create a new controller inFrontende.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {


        $keyword = 'thinkpad';
        // return $this->bukalapak($keyword);
        return $this->shopee($keyword);

        return view('page/dashboard');
    }
    public function bukalapak($keyword)
    {
        try {
            // echo 'halooo';
            $url = 'https://www.bukalapak.com/products?utf8=%E2%9C%93&source=navbar&from=omnisearch&search_source=omnisearch_organic&from_keyword_history=false&search%5Bkeywords%5D='.$keyword;
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $url);

            // echo $response->getStatusCode(); // 200
            // echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
            $html=''.$response->getBody();
            $crawler = new Crawler($html);
            // $crawler->filter('body');
            // print_r($crawler);
            $items = $crawler->filter('.product-gallery.products.row-grid > li > div')->each(function (Crawler $node, $i) {
                // echo $node->html();
                // echo $node->text();
                // echo $node->filter('source')->attr('data-src');
                $title =  $node->filter('h3 > a')->text();
                $image =  $node->filter('source')->attr('data-src');
                $item = [
                    'title' => $title,
                    'image' => $image,
                ];
                return $item;
            });
            print_r($items);

        } catch (ClientErrorResponseException $exception) {
            print_r($exception);
        }
    }
    public function shopee($keyword)
    {
        try {
            // pakai curl
            $curl = curl_init('https://www.lazada.co.id/catalog/?spm=a2o4j.home.search.1.57991559wJUuOu&q=thinkpad&_keyori=ss&from=search_history&sugg=thinkpad_0_1');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);

            $page = curl_exec($curl);

            if(curl_errno($curl)) // check for execution errors
            {
                echo 'Scraper error: ' . curl_error($curl);
                exit;
            }

            curl_close($curl);
            echo $page;
            // $regex = '/<div id="case_textlist">(.*?)<\/div>/s';
            // if ( preg_match($regex, $page, $list) )
            //     echo $list[0];
            // else
            //     print "Not found";

            // end

            // pakai Goutte
            // $url = 'https://www.symfony.com/blog/';

            // $client = new Client();
            // $crawler = $client->request('GET', $url);
            // // print_r($crawler);
            // // Get the latest post in this category and display the titles
            // $crawler->filter('h2 > a')->each(function ($node) {
            //     print $node->text()."\n";
            // });

            // end


        } catch (ClientErrorResponseException $exception) {
            print_r($exception);
        }
    }

}
