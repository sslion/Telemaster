<?php namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use App\Models\UserModel;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $uri = service('uri');

        if (!session()->get('isLoggedIn') && $uri->getSegment(1) == 'user') {
            return redirect()->route('user_login');
        }
        if (!session()->get('isLoggedIn')  && $uri->getSegment(1) == 'manager') {
            return redirect()->route('manager_login');
        }
        if (!session()->get('isLoggedIn')  && $uri->getSegment(1) == 'admin') {
            return redirect()->route('admin_login');
        }
        if (session()->get('isLoggedIn')  && $uri->getSegment(1) == 'admin') {
            $user_id = session()->get('user')["id"];
            $user = (new UserModel())->find($user_id);
            session()->remove("user");
            session()->set(['isLoggedIn' => false]);
            if(!$user["active"]) {
                return redirect()->to('/');
            }
            session()->set(['isLoggedIn' => true]);
            session()->set(['user' => $user]);
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
