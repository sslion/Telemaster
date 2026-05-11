<?php

namespace App\Controllers;

use App\Models\MenuModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];
    private $defaultTitle = "Telemaster";
    protected array $data = [];
    protected string $cur_menu = '';
    protected string $cur_sub_menu = '';
    protected string $title = 'Кабинет администратора';
    protected string $uri = '';

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @param LoggerInterface $logger
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        $this->uri = $uri = service('uri');
//        dd($uri->getSegments());
        if($uri->getSegment(1) == "manager") {
            $this->cur_menu = ($uri->getSegment(2)) ? $uri->getSegment(2) : "";
            if(count($uri->getSegments()) > 2) {
                $this->cur_sub_menu = ($uri->getSegment(3)) ? $uri->getSegment(3) : "";
            }
        }
        $this->data['cur_menu'] = $this->cur_menu;
        $this->data['cur_sub_menu'] = $this->cur_sub_menu;
        $this->data['title'] = "";

        $menu = (new MenuModel())->getAdminMenu();
        //dd([$this->cur_menu, $menu]);
        if(key_exists($this->cur_menu, $menu)) {
            $this->data['title'] = $menu[$this->cur_menu]["title"];
            if(key_exists("childs", $menu[$this->cur_menu]) && key_exists($this->cur_sub_menu, $menu[$this->cur_menu]["childs"])) {
                $this->data['title'] .= " - " . $menu[$this->cur_menu]["childs"][$this->cur_sub_menu]["title"];
            }
        }
    }

    /**
     * @param array $data
     * @param null  $template
     */
    public function render($data, $template = null)
    {
        $data = $data ?? $this->data;

        if(empty($data['title']))
            $data['title'] = $this->defaultTitle;

        if(empty($data['content']))
            $data['content'] = '';

        $data['uri'] = $this->uri;

        if(!$template) {
            $template = env('DEFAULT_ADMIN_TEMPLATE');
        }
        echo view($template, $data);
    }

    function statusSuccess($message = '', $data = null) {
        $result = [
            "status" => "success",
            "message" => $message,
        ];
        if($data && is_array($data)) {
            $result = array_merge($result, $data);
        }
        echo json_encode($result); exit();
    }
    function statusError($message = '', $data = null) {
        $result = [
            "status" => "error",
            "message" => $message,
        ];
        if($data && is_array($data)) {
            $result = array_merge($result, $data);
        }
        echo json_encode($result); exit();
    }
}
