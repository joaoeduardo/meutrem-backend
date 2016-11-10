<?php

namespace App\Http\Controllers;

use App\Entities\Status;
use App\Repositories\StatusRepository;
use App\Transformers\StatusTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;

class StatusController extends Controller
{

    /**
     *
     * @param Request $request
     * @param StatusRepository $repository
     * @param Fractal $serializer
     */
    public function readAll(Request $request, StatusRepository $repository, Fractal $serializer)
    {
        $paginator = $repository->paginateAll();

        $lines = $paginator->getCollection();

        return $serializer->collection($lines)
            ->transformWith(new StatusTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->parseIncludes($request->input('include'))
            ->withResourceName('status')
            ->toArray();
    }

    /**
     *
     * @param Request $request
     * @param StatusRepository $repository
     * @param Fractal $serializer
     * @param unknown $id
     */
    public function read(Request $request, StatusRepository $repository, Fractal $serializer, $id)
    {
        $line = $repository->find($id);

        return $serializer->item($line)
            ->transformWith(new StatusTransformer())
            ->parseIncludes($request->input('include'))
            ->withResourceName('status')
            ->toArray();
    }
}
