<?php

namespace App\Http\Controllers;

use App\Entities\Line;
use App\Repositories\LineRepository;
use App\Transformers\LineTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;

class LineController extends Controller
{

    /**
     *
     * @param Request $request
     * @param LineRepository $repository
     * @param Fractal $serializer
     */
    public function readAll(Request $request, LineRepository $repository, Fractal $serializer)
    {
        $paginator = $repository->paginateAll();

        $lines = $paginator->getCollection();

        return $serializer->collection($lines)
            ->transformWith(new LineTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->parseIncludes($request->input('include'))
            ->withResourceName('line')
            ->toArray();
    }

    /**
     *
     * @param Request $request
     * @param LineRepository $repository
     * @param Fractal $serializer
     * @param unknown $id
     */
    public function read(Request $request, LineRepository $repository, Fractal $serializer, $id)
    {
        $line = $repository->find($id);

        return $serializer->item($line)
            ->transformWith(new LineTransformer())
            ->parseIncludes($request->input('include'))
            ->withResourceName('line')
            ->toArray();
    }
}
