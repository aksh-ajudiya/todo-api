<?php
namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    public function index()
    {
        $data = Task::orderBy('id','DESC')->get();
        
        return response()->json(['status' => true,'message' => 'All Task get successfully !', 'data'=>$data]);
    
    }

     public function show($id)
    {
        $response = array("status" => false, 'message' => '');

       $task = Task::find($id);
    
            if (!$task) {
                return response()->json(['status' => false, 'message' => 'Task not found!'], 404);
            }

        return response()->json(['status' => true, 'message' => 'Task data get successfully !' , 'data' => $task]);
    }

    public function store(Request $request)
    {
        $response = array("status" => false, 'message' => '');
        $requestData = $request->all();

        $rules = [
           'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'boolean',
        ];

        $validator = Validator::make($requestData, $rules);
    
        if ($validator->fails()) {
            $response['message'] = $validator->messages();
        } else {

            $task = new Task();
            $task->title = $requestData['title'];
            $task->description = $requestData['description'];

            if (isset($requestData['status'])) {
                $task->status = $requestData['status'];
            }

            $task->save();
    
            if ($task) {
                $response = response()->json(['status' => true, 'message' => 'Task Created Successfully !']);
            } else {
                $response = response()->json(['status' => false, 'message' => 'Failed to create task !']);
            }
        }
    
        return $response;
    }

    public function update(Request $request, $id)
    {
        $response = array("status" => false, 'message' => '');
        $requestData = $request->all();
     
    
        $rules = [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|boolean',
        ];
    
        $validator = Validator::make($requestData, $rules);
    
        if ($validator->fails()) {
            $response['message'] = $validator->messages();
        } else {
            
            $task = Task::find($id);
    
            if (!$task) {
                return response()->json(['status' => false, 'message' => 'Task not found!'], 404);
            }
    
            if (isset($requestData['title'])) {
                $task->title = $requestData['title'];
            }
    
            if (isset($requestData['description'])) {
                $task->description = $requestData['description'];
            }
    
            // dd($requestData['status']);

            if (isset($requestData['status'])) {
                
                $task->status = $requestData['status'];
            }
    
            $task->save();
         
            
    
            if ($task) {
                $response = response()->json(['status' => true, 'message' => 'Task Updated Successfully!']);
            } else {
                $response = response()->json(['status' => false, 'message' => 'Failed to update task!']);
            }
        }
    
        return $response;
    }
    

    public function destroy($id)
    {
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['status' => 'false', 'message' => 'Task not found'], 404);
        }

        $task->delete();

        return response()->json(['status' => 'true','message' => 'Task deleted successfully']);
    }

    public function filter(Request $request)
    {

        $status = $request->input('status'); 
            
        
        $query = Task::query();
    
        if (!is_null($status)) {
            $query->where('status', $status);
        }
    
        $tasks = $query->get();
 
    
    
        if ($status === '1') {
            return response()->json([
                'status' => true,
                'message' => 'Completed Tasks retrieved successfully!',
                'data' => $tasks
            ], 200);
        } elseif ($status === '0') {
            return response()->json([
                'status' => true,
                'message' => 'Uncompleted Tasks retrieved successfully!',
                'data' => $tasks
            ], 200);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Tasks get successfully!',
                'data' => $tasks
            ], 200);
        }
    }
    

}
?>



