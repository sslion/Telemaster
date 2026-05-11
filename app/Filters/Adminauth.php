<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Adminauth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = service('uri');

        if(! session()->get('isLoggedIn') && ($uri->getSegment(1) == 'admin' || $uri->getSegment(1) == 'user')){
            return redirect()->route('admin_login');
        }
        if(session()->get('isLoggedIn')){
            return redirect()->route('user_main');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
