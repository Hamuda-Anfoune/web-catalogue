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
        // TODO: make sure that only the domain is stored and that it is unique, should do it in the request validation


        // $request->validate([
        //     'categories' => 'array|integer|in:categories',
        //     'name' => 'search|string|max:255',
        //     'name' => '|string|max:255',
        // ]);

        // $name = $request->get('name');

        // $task = Task::create(['name' => $name]);

        // return redirect()->route('tasks.list');
    }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'done' => 'required|string',
        // ]);

        // try {
        //     /** @var Task $task */
        //     $task = Task::findOrFail($id);
        //     $task->update(['done' => $request->get('done')]);
        //     $task->save();

        // } catch (\Exception $e) {
        //     // TODO: log and/or return error message instead of of silently failing
        // }

        // return redirect()->route('tasks.list');
    }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function destroy($id)
    {
        // try {
        //     /** @var Task $task */
        //     $task = Task::findOrFail($id);
        //     $task->delete();

        // } catch (\Exception $e) {
        //     // TODO: log and/or return error message instead of silently failing
        // }

        // return redirect()->route('tasks.list');
    }
}
