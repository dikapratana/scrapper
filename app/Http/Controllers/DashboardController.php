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
        // return $this->test($keyword);
        // return $this->convert($keyword);

        return view('page/dashboard');
    }
    public function crawling(Request $request)
    {
        return $this->bukalapak( $request);
    }
    public function bukalapak( $request)
    {
        $keyword = $request->keyword;
        $filter = $request->filter;
        $url = 'https://www.bukalapak.com/products?utf8=%E2%9C%93&search%5Bkeywords%5D='.$keyword.'&search%5Bsort_by%5D='.$filter.'';
        try {
            $client = new \GuzzleHttp\Client();
            $response = $client->request('GET', $url);

            // echo $response->getStatusCode(); // 200
            // echo $response->getHeaderLine('content-type'); // 'application/json; charset=utf8'
            $html=''.$response->getBody();
            $crawler = new Crawler($html);
            // $crawler->filter('body');
            // print_r($crawler);
            // echo $html;
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
            $data['html'] = '';
            // return  response()->json($items);
            if(!empty($items)){
                foreach($items as $key => $value){
                    $data['html'] .= '<div class="col-md-3">';
                        $data['html'] .= '<div class="box box-widget widget-user">';
                        $data['html'] .= '<div class="widget-user-header bg-black" style="background: url('.$value['image'].') center center;">';
                        $data['html'] .= '</div>';
                        $data['html'] .= '<div class="widget-user-image">';
                        $data['html'] .= '</div>';
                        $data['html'] .= '<div class="box-footer">';
                            $data['html'] .= '<div class="row">';
                            $data['html'] .= '<div class="col-md-12 border-right">';
                                $data['html'] .= '<div class="description-block">';
                                $data['html'] .= '<h5 class="description-header" title="'.$value['title'].'">'.\Illuminate\Support\Str::limit($value['title'], 20, $end='...') .'</h5>';
                                $data['html'] .= '<span class="description-text">SALES</span>';
                                $data['html'] .= '</div>';
                            $data['html'] .= '</div>';
                            $data['html'] .= '</div>';
                        $data['html'] .= '</div>';
                        $data['html'] .= '</div>';
                    $data['html'] .= '</div>';
                }
            }else{
                $data['html'] .= '<div class="col-md-12">';
                    $data['html'] .= '<div class="card card-primary">';
                    $data['html'] .= '<div class="card-body">';
                        $data['html'] .= 'Data Not Found';
                    $data['html'] .= '</div>';
                   $data['html'] .= ' </div>';
                $data['html'] .= '</div>';
            }



            return  response()->json($data);

        } catch (ClientErrorResponseException $exception) {
            $data['html'] = '';
            $data['html'] .= '<div class="col-md-12">';
                $data['html'] .= '<div class="card card-primary">';
                $data['html'] .= '<div class="card-body">';
                    $data['html'] .= ''.$exception.'';
                $data['html'] .= '</div>';
                $data['html'] .= ' </div>';
            $data['html'] .= '</div>';
            return  response()->json($data);
        }
    }
    public function shopee($keyword)
    {
        try {
            $url = 'https://www.jd.id/search?keywords=thinkpad&sortType=sort_commentcount_desc';
            $client = new Client();
            $crawler = $client->request('GET', $url);
            print_r($crawler);
            // Get the latest post in this category and display the titles
            $crawler->filter('span')->each(function ($node) {
                print $node->text()."\n";
            });

        } catch (ClientErrorResponseException $exception) {
            print_r($exception);
        }
    }

    public function test($keyword)
    {



        try {
            //  Create a new Goutte client instance
    $client = new Client();

    //  Hackery to allow HTTPS
       $guzzleclient = new \GuzzleHttp\Client([
           'timeout' => 60,
           'verify' => false,
       ]);

       // Create DOM from URL or file
       $html = file_get_html('https://www.facebook.com');

       // Find all images
       foreach ($html->find('img') as $element) {
           echo $element->src . '<br>';
       }

       // Find all links
       foreach ($html->find('a') as $element) {
           echo $element->href . '<br>';
       }

        } catch (ClientErrorResponseException $exception) {
            print_r($exception);
        }
    }


}
