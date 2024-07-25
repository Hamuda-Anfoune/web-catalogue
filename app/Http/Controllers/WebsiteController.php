<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GetWebsitesRequest;
use App\Repositories\WebsiteRepository;

class WebsiteController extends Controller
{
    protected $repository;
    /**
     * Display a listing of the websites.
     *  
     * @param GetWebsitesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(GetWebsitesRequest $request, WebsiteRepository $repository)
    {
        // FYI: all users can view all websites, no user restrictions here!
        $page = $request->get('page', 1);
        $categories = $request->get('categories', []);
        $searchTerm = $request->get('search', '');

        // use repository
        $this->repository = $repository;

        // set up filters on repository
        $this->repository
            ->setResultsPage($page)
            ->setCategories($categories)
            ->setSearchTerm($searchTerm);

        // FYI: Includes pagination details
        return $this->repository->get();
    }

    /**
     * Store a new website.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: make sure that only the domains are stored and that it is unique, should do it in the request validation
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
