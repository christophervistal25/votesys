<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Position;
use App\Repositories\PositionRepository;
use Illuminate\Http\Request;


class PositionController extends Controller
{

    public function __construct(PositionRepository $positionRepository)
    {
        $this->positionRepository  = $positionRepository;
    }


    public function index()
    {
        $positions = $this->positionRepository
                           ->position::all();
        return view('admin.position.index',compact('positions'));
    }

    public function edit($id)
    {
        $position = $this->positionRepository->getPositionById($id);
        return view('admin.position.edit',compact('position'));
    }

    public function update($id , UpdatePositionRequest $request)
    {
        if($this->positionRepository->updatePosition($id , $request->all())) {
            setFlashMessage('status','Successfully edit ' . $request->name);
            return redirect()->route('position.index');
        }
    }

    public function create()
    {
        return view('admin.position.create');
    }

    public function store(StorePositionRequest $request)
    {
        $this->positionRepository
                         ->createNewPosition($request->all());
        setFlashMessage('status','Successfully add new position');
        return redirect()->route('position.index');
    }

    public function destroy(int $id)
    {
        $this->positionRepository
                    ->deletePosition($id);
        return redirect()->route('position.index');
    }

}
