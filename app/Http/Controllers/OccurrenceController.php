<?php

namespace App\Http\Controllers;

use App\Entities\Occurrence;
use App\Repositories\OccurrenceRepository;
use App\Transformers\OccurrenceTransformer;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Spatie\Fractal\Fractal;

class OccurrenceController extends Controller
{

    /**
     * @param Request $request
     * @param OccurrenceRepository $repository
     * @param Fractal $serializer
     */
    public function readAll(Request $request, OccurrenceRepository $repository, Fractal $serializer)
    {
        $paginator = $repository->paginateAll();

        $lines = $paginator->getCollection();

        return $serializer->collection($lines)
            ->transformWith(new OccurrenceTransformer())
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->parseIncludes($request->input('include'))
            ->withResourceName('occurrence')
            ->toArray();
    }

    /**
     *
     * @param Request $request
     * @param OccurrenceRepository $repository
     * @param Fractal $serializer
     * @param unknown $id
     */
    public function read(Request $request, OccurrenceRepository $repository, Fractal $serializer, $id)
    {
        $line = $repository->find($id);

        return $serializer->item($line)
            ->transformWith(new OccurrenceTransformer())
            ->parseIncludes($request->input('include'))
            ->withResourceName('occurrence')
            ->toArray();
    }
}
