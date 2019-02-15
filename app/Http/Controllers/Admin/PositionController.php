<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Position;
use App\Repositories\PositionRepository;


class PositionController extends Controller
{

    public function __construct(PositionRepository $positionRepo)
    {
        $this->positionRepo = $positionRepo;
    }


    public function index()
    {
        $positions = Position::all();
        return view('admin.position.index',compact('positions'));
    }

    public function edit($id)
    {
        return $this->positionRepo->getPositionById($id);
    }

    public function create()
    {
        return view('admin.position.create');
    }

    public function store(Request $request)
    {
        if (!$this->positionRepo->alreadyExists($request->position)) {
            return $this->positionRepo
                         ->createNewPosition($request->all());
        } else {
            //display warning message here that the position is already exists
            dd('Already exists');
        }
    }

    public function destroy(int $id)
    {
        return $this->positionRepo
                    ->deletePosition($id);
    }

}
