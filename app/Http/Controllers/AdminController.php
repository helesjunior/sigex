<?php

namespace app\Http\Controllers;

use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    protected $data = []; // the information we send to the view

    public function __construct()
    {
        $this->middleware(backpack_middleware());
    }

    public function index()
    {
        $this->data['title'] = trans('dashboard'); // set the page title
        $this->data['breadcrumbs'] = [
            trans('Sigex')     => backpack_url('dashboard'),
            trans('dashboard') => false,
        ];

        return view(backpack_view('dashboard'), $this->data);
    }

    public function redirect()
    {
        // The '/admin' route is not to be used as a page, because it breaks the menu's active state.
        return redirect(backpack_url('dashboard'));
    }
}
