<?php

namespace App\Repositories;

use App\Models\Website;
use Illuminate\Database\Eloquent\Collection;
use \Illuminate\Http\Response;

use Illuminate\Database\Eloquent\Builder;

class WebsiteRepository
{
    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var array
     */
    protected $categories = [];

    /** @var string */
    protected $searchTerm = '';

    /**
     * @var Builder
     */
    protected $query;

    public function setResultsPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    public function setCategories(array $categories): self
    {
        $this->categories = $categories;

        return $this;
    }

    public function setSearchTerm(string $searchTerm): self
    {
        $this->searchTerm = $searchTerm;

        return $this;
    }

    public function get(): Response
    {
        // Init
        $this->query = Website::query();
        
        // No filters, obviously! :)
        if (empty($this->categories) && empty($this->searchTerm)) {
            // TODO: modify to use raw queries for optimisation
            // TODO: modify to order by categories, maybe even group by them
            return $this->paginate();
        }

        if (!empty($this->categories)) {
            $this->query->whereHas('categories', function ($query) {
                $query->whereIn('category_id', $this->categories);
            })->get();
        }

        if (!empty($this->searchTerm)) {
            $this->query->where('title', 'like', "%{$this->searchTerm}%");
        }

        return $this->paginate();
    }

    private function paginate(): Response
    {
        $paginator = $this->query->paginate(Website::DEFAULT_RESULTS_PER_PAGE, ['*'], 'page', $this->page);

        return new Response(
            $paginator->items(),
            Response::HTTP_OK,
            [
                "X-Pagination-TotalPages" => $paginator->lastPage(),
                "X-Pagination-CurrentPage" => $paginator->currentPage(),
                "X-Pagination-PerPage" => $paginator->perPage(),
                "X-Pagination-TotalResults" => $paginator->lastItem(),
            ]
        );
    }
}
