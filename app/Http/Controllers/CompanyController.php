<?php

namespace App\Http\Controllers;

use App\Entities\Company;
use App\Repositories\CompanyRepository;
use App\Transformers\CompanyTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;

class CompanyController extends Controller
{

    /**
     *
     * @param Request $request
     * @param CompanyRepository $repository
     * @param Fractal $serializer
     */
    public function readAll(Request $request, CompanyRepository $repository, Fractal $serializer)
    {
        $paginator = $repository->paginateAll();

        $lines = $paginator->getCollection();

        return $serializer->collection($lines)
            ->transformWith(new CompanyTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->parseIncludes($request->input('include'))
            ->withResourceName('company')
            ->toArray();
    }

    /**
     *
     * @param Request $request
     * @param CompanyRepository $repository
     * @param Fractal $serializer
     * @param unknown $id
     */
    public function read(Request $request, CompanyRepository $repository, Fractal $serializer, $id)
    {
        $line = $repository->find($id);

        return $serializer->item($line)
            ->transformWith(new CompanyTransformer())
            ->parseIncludes($request->input('include'))
            ->withResourceName('company')
            ->toArray();
    }
}
