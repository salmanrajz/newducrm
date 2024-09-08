<?php

namespace App\Http\Controllers;

use App\Models\exam_category;
use App\Models\question_bank_answer;
use App\Models\question_bank_list;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class ExamController extends Controller
{
    //
    // Blog Category
    public function CategoryCreate(Request $request)
    {
        // return $request;
        $validator = Validator::make($request->all(), [ // <---
            'category_name' => [
                'required',
                Rule::unique('exam_categories')->ignore($request->id),
            ],
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $role = exam_category::create(
            [
                'category_name' => $request->category_name,
                'status' => 1
            ]
        );
        return response()->json(['success' => 'Category has been Added']);
    }
    //
    public function QuestionStart(Request $request)
    {
        // return "Boom";
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],  ['name' => "Exam Category Manager"]
        ];
        // $data = Role:all
        $data = exam_category::select('exam_categories.category_name', 'exam_categories.id as exam_category_id', 'question_bank_lists.id as question_id', 'question_bank_lists.question')
        ->Join(
            'question_bank_lists',
            'question_bank_lists.category_id',
            'exam_categories.id'
        )
        // ->where('exam_categories.id', $request->category_id)
        ->inRandomOrder()
        ->limit(20)
        ->get();
        // if ($data->count() > 0) {
        //     $question = array();

        //     foreach ($data as $o) {
        //         //  $question;
        //         $question =  $o->question;
        //         $quiz_id =  $o->question_id;
        //         // $question['options'] = question_bank_answer::select('answer')->where('quiz_id', $o['question_id'])->get()->toArray();
        //         // $question['correct'] = question_bank_answer::select('correct')->where('quiz_id', $o['question_id'])->get()->toArray();

        //         $data2 = question_bank_answer::where('quiz_id', $o->question_id)->get();
        //         //     // }
        //         //     // return $option = $data2->answer['1'];
        //         //     // foreach ($data2 as $key => $l){
        //         //     //     $k = [
        //         //     //         'answer' . $key => $l->answer,
        //         //     //         // 'answer1' . $key => $l->answer,
        //         //     //     ];
        //         //     // }

        //         //     // return $k;
        //         //     // return $o->question_id;
        //         $options = array();
        //         $correct = array();
        //         $correct = 1;
        //         foreach ($data2 as $key => $username) {
        //             // return $key;
        //             $options[] = $username->answer;
        //             if ($key == 0) {
        //                 if ($username->correct == 1) {
        //                     $correct = 1;
        //                 }
        //             } elseif ($key == 1
        //             ) {
        //                 // return "2";
        //                 // return $key;
        //                 if ($username->correct == 1) {
        //                     $correct = 2;
        //                 }
        //             } elseif ($key == 2
        //             ) {
        //                 // return $username->correct;
        //                 if ($username->correct == 1) {
        //                     $correct = 3;
        //                 }
        //             } elseif ($key == 3
        //             ) {
        //                 if ($username->correct == 1) {
        //                     $correct = 4;
        //                 }
        //             }
        //             // $correct[] = $username->correct;
        //         }

        //         $l[] =  [
        //             'id' => $quiz_id,
        //             'questions' => $question,
        //             'option' => $options,
        //             'correct' => $correct,
        //             // 'answer' => $answer,

        //         ];
        //     }
        // }
        // return $l;
        // return $k;
        //  response()->json(
        //     [
        //         'ResponseCode' => '1',
        //         'ResponseMessage' => 'Survey Quiz',
        //         'ResponseData' => $l,
        //         // 'quiz' => $l,
        //     ],
        //     200
        // );
        // $data = question_bank_list::all();
        return view('admin.exam.question-start', compact('data', 'breadcrumbs'));

        // return view('admin.role.view-category', compact('data', 'breadcrumbs'));
    }
    public function category(Request $request)
    {
        // return "Boom";
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],  ['name' => "Exam Category Manager"]
        ];
        // $data = Role:all
        $data = exam_category::all();
        return view('admin.exam.view-exam-category', compact('data', 'breadcrumbs'));

        // return view('admin.role.view-category', compact('data', 'breadcrumbs'));
    }
    //
    //
    public function editcategory(Request $request)
    {
        // return "Boom";
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],  ['name' => "Exam Category Manager"]
        ];
        // $data = Role:all
        $role = exam_category::findorfail($request->id);
        return view('admin.exam.edit-category', compact('role', 'breadcrumbs'));

        // return view('admin.role.view-category', compact('data', 'breadcrumbs'));
    }
    //
    public function addcategory(Request $request)
    {
        // return "Boom";
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],  ['name' => "Add Exam Category Manager"]
        ];
        // $data = Role:all
        $role = exam_category::all();
        return view('admin.exam.add-category', compact('role', 'breadcrumbs'));

        // return view('admin.role.view-category', compact('data', 'breadcrumbs'));
    }
    //
    //
    public function AllQuestionBank(Request $request)
    {
        // return "Boom";
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],  ['name' => "All Question List"]
        ];
        // $data = Role:all
        $data = question_bank_list::select('question_bank_lists.question', 'question_bank_lists.id', 'question_bank_lists.status', 'exam_categories.category_name')
            ->Join(
                'exam_categories',
                'exam_categories.id',
                'question_bank_lists.category_id'
            )
            ->get();
        return view('admin.exam.view-exam-quiz', compact('data', 'breadcrumbs'));

        // return view('admin.role.view-category', compact('data', 'breadcrumbs'));
    }
    //
    public function EditBlogCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [ // <---
            'category_name' => [
                'required',
                Rule::unique('exam_categories')->ignore($request->id),
            ],
            'status' => 'required',
            // 'description' => 'required',
            // 'heading' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $data = exam_category::findorfail($request->id);
        $data->update([
            'category_name' => $request->category_name,
            'status' => $request->status,
            // 'description' => $request->description,
            // 'heading' => $request->heading,
            // 'title' => $request->title,
        ]);
        return response()->json(['success' => 'Category has been Updated']);

        // $log = CustomLog::create([
        //     'userid' => auth()->user()->id,
        //     'task_name' => $request->task_name,
        //     'page_name' => $request->page_name,
        //     'task_id' => $request->id,
        // ]);
        // return view('.admin.role.edit-airport', compact('data'));

    }
    public function CategoryDelete(Request $request)
    {

        $data = exam_category::findorfail($request->id);
        $data->delete();
        return "1";
    }
    public function QuizDelete(Request $request)
    {

        $data = question_bank_list::findorfail($request->id);
        $data->delete();
        return "1";
    }
    //
    public function AddQuestionBank(Request $request)
    {
        // return "Boom";
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],  ['name' => "Add Question Bank"]
        ];
        // $data = Role:all
        $category = exam_category::where('status', 1)->get();
        // $tag = mytags::where('status', 1)->get();
        return view('admin.exam.add-quiz', compact('category'));
    }
    //
    public function EditQuiz(Request $request)
    {
        // return "Boom";
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"],  ['name' => "Edit Question"]
        ];
        // $data = Role:all
        $category = exam_category::where('status', 1)->get();
        // $tag = mytags::where('status', 1)->get();
        $data = question_bank_list::findorfail($request->slug);
        return view('admin.exam.edit-quiz', compact('category', 'data'));
    }
    //
    public function upload_image(Request $request)
    {
        // return $request;
        if ($file = $request->file('file')) {
            $mytime = Carbon::now();
            $ext =  $mytime->toDateTimeString();
            $name = $ext . '-' . $file->getClientOriginalName();
            // $name = Str::slug($name, '-');
            $file->move('documents', $name);
        }
        // return
        // return response()->json([''], 422);
        return response()->json(['success' => 'Image Added'], 200);
    }
    public function QuizAdd(Request $request)
    {

        // return $request;
        $validator = Validator::make($request->all(), [ // <---
            'question' => [
                'required',
                Rule::unique('question_bank_lists')->ignore($request->id),
            ],
            'category' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            // 'answer3' => 'required',
            // 'answer4' => 'required',
            'selected_answer' => 'required',
            // 'status' => 'required',
            // 'description' => 'required',
            // 'heading' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $correct = $request->selected_answer;
        if ($correct == 1) {
            $z = array('', '1', '0', '0', '0');
        } else if ($correct == 2) {
            $z = array('', '0', '1', '0', '0');
        } else if ($correct == 3) {
            $z = array('', '0', '0', '1', '0');
        } else if ($correct == 4) {
            $z = array('', '0', '0', '0', '1');
        } else {
            $z = array('', '0', '0', '0', '0');
        }
        // return $z;
        $data = question_bank_list::create([
            'question' => $request->question,
            'category_id' => $request->category,
        ]);
        for ($i = 1; $i <= 4; $i++) {
            $k = $z[$i];
            $data2 = question_bank_answer::create([
                'quiz_id' => $data->id,
                'answer' => $request['answer' . $i],
                'correct' => $k,
            ]);
            // return $request['answer' . 1];
            //
            //         // echo
            //         $abcd = escape($_POST['answer_id' . $i]);
            //         // echo $resource . '<br>';
            //         // echo "<br>" . $a;
            //         // $k = $z[$i];
            //         $a = escape($_POST['question_answer' . $i]);
            //         // echo "<br>" . $a;
            //         $k = $z[$i];

            //         $qs = question_bank_answer::sam($abcd);
            //         $qs->quiz_id = $quiz_id;
            //         $qs->answer = $a;
            //         $qs->correct = $k;
            //         $qs->points = 1;
            //         $qs->status = 1;
            //         $qs->save();
            //         // if($qs->create()){
            //         echo "success_add";
        }

        // if ($_POST['question_bank_val_save'] == 'yes') {
        //     $question_title = escape($_POST['question_title']);
        //     $answer_1 = escape($_POST['question_answer1']);
        //     $answer_2 = escape($_POST['question_answer2']);
        //     $answer_3 = escape($_POST['question_answer3']);
        //     $answer_4 = escape($_POST['question_answer4']);

        //     $correct = escape($_POST['correct']);
        //     $points = escape($_POST['points']);
        //     $test_category = escape($_POST['test_category']);
        //     $subject_id = escape($_POST['subject_id']);

        //     $form = true;
        //     $error = '';

        //     if (empty($question_title)) {
        //         $form = false;
        //         $error .= "=> Question Title is empty <br>";
        //     }
        //     if (empty($subject_id)) {
        //         $form = false;
        //         $error .= "=> Subject Title is empty <br>";
        //     }
        //     if (empty($answer_1)) {
        //         $form = false;
        //         $error .= "=> Answer 1 is empty <br>";
        //     }
        //     if (empty($answer_2)) {
        //         $form = false;
        //         $error .= "=> Answer 2 is empty <br>";
        //     }
        //     if (empty($answer_3)) {
        //         $form = false;
        //         $error .= "=> Answer 3 is empty <br>";
        //     }
        //     if (empty($answer_4)) {
        //         $form = false;
        //         $error .= "=> Answer 4 is empty <br>";
        //     }
        //     if (empty($correct)) {
        //         $form = false;
        //         $error .= "=> Correct option is empty <br>";
        //     }
        //     if (empty($test_category)) {
        //         $form = false;
        //         $error .= "=> Test Category is missing <br>";
        //     }
        //     $quiz_id = escape($_POST['question_id']);

        //     $sql = "SELECT * from question_bank_list where question_title = '$question_title' and id != '$quiz_id' and status = 1";
        //     $r  = query($sql);
        //     confirm($r);
        //     $count = row_count($r);
        //     if ($count > 0) {
        //         $form = false;
        //         $error .= "=> Question Already exist <br>";
        //     }

        // echo "<br>" . $question_title . '<br>';
        // echo "<br>" . $answer_1 . '<br>';
        // echo "<br>" . $answer_2 . '<br>';
        // echo "<br>" . $answer_3 . '<br>';
        // echo "<br>" . $answer_4 . '<br>';
        // echo "<br>" . $correct . '<br>';

        // $resource = escape(implode(',',$_POST['answer_id']));
        // echo "<br>";
        // $ar = explode(',',$resource);
        // echo $ar;
        // if ($form) {
        //     // echo $quiz_id;
        //     $qbl = question_bank_list::sam($quiz_id);
        //     $qbl->question_title = $question_title;
        //     $qbl->category_id = $test_category;
        //     $qbl->quiz_id = $subject_id;
        //     $qbl->type = 'Multiple';
        //     $qbl->status = 1;
        //     $qbl->save();
        //     // $bb = question_bank_list::last_id_search_zero();
        //     // $bbid =  $bb->id;

        //     for ($i = 1; $i <= 4; $i++) {
        //         // echo
        //         $abcd = escape($_POST['answer_id' . $i]);
        //         // echo $resource . '<br>';
        //         // echo "<br>" . $a;
        //         // $k = $z[$i];
        //         $a = escape($_POST['question_answer' . $i]);
        //         // echo "<br>" . $a;
        //         $k = $z[$i];

        //         $qs = question_bank_answer::sam($abcd);
        //         $qs->quiz_id = $quiz_id;
        //         $qs->answer = $a;
        //         $qs->correct = $k;
        //         $qs->points = 1;
        //         $qs->status = 1;
        //         $qs->save();
        //         // if($qs->create()){
        //         echo "success_add";
        //     }
        // } else {
        //     echo $error;
        // }
        return response()->json(['success' => 'question has been Added']);
    }
    public function QuizUpdate(Request $request)
    {

        // return $request;
        $validator = Validator::make($request->all(), [ // <---
            'question' => [
                'required',
                Rule::unique('question_bank_lists')->ignore($request->id),
            ],
            'category' => 'required',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'selected_answer' => 'required',
            // 'status' => 'required',
            // 'description' => 'required',
            // 'heading' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()]);
        }
        $correct = $request->selected_answer;
        if ($correct == 1) {
            $z = array('', '1', '0', '0', '0');
        } else if ($correct == 2) {
            $z = array('', '0', '1', '0', '0');
        } else if ($correct == 3) {
            $z = array('', '0', '0', '1', '0');
        } else if ($correct == 4) {
            $z = array('', '0', '0', '0', '1');
        } else {
            $z = array('', '0', '0', '0', '0');
        }
        // return $z;
        $data = question_bank_list::updateOrCreate(['id' => $request->id], [
            // $data = question_bank_list::create([
            'question' => $request->question,
            'category_id' => $request->category,
        ]);
        $data3 = question_bank_answer::where('quiz_id', $request->id)->delete();
        for ($i = 1; $i <= 4; $i++) {
            $k = $z[$i];
            $data2 = question_bank_answer::create([
                'quiz_id' => $data->id,
                'answer' => $request['answer' . $i],
                'correct' => $k,
            ]);
            // return $request['answer' . 1];
            //
            //         // echo
            //         $abcd = escape($_POST['answer_id' . $i]);
            //         // echo $resource . '<br>';
            //         // echo "<br>" . $a;
            //         // $k = $z[$i];
            //         $a = escape($_POST['question_answer' . $i]);
            //         // echo "<br>" . $a;
            //         $k = $z[$i];

            //         $qs = question_bank_answer::sam($abcd);
            //         $qs->quiz_id = $quiz_id;
            //         $qs->answer = $a;
            //         $qs->correct = $k;
            //         $qs->points = 1;
            //         $qs->status = 1;
            //         $qs->save();
            //         // if($qs->create()){
            //         echo "success_add";
        }

        // if ($_POST['question_bank_val_save'] == 'yes') {
        //     $question_title = escape($_POST['question_title']);
        //     $answer_1 = escape($_POST['question_answer1']);
        //     $answer_2 = escape($_POST['question_answer2']);
        //     $answer_3 = escape($_POST['question_answer3']);
        //     $answer_4 = escape($_POST['question_answer4']);

        //     $correct = escape($_POST['correct']);
        //     $points = escape($_POST['points']);
        //     $test_category = escape($_POST['test_category']);
        //     $subject_id = escape($_POST['subject_id']);

        //     $form = true;
        //     $error = '';

        //     if (empty($question_title)) {
        //         $form = false;
        //         $error .= "=> Question Title is empty <br>";
        //     }
        //     if (empty($subject_id)) {
        //         $form = false;
        //         $error .= "=> Subject Title is empty <br>";
        //     }
        //     if (empty($answer_1)) {
        //         $form = false;
        //         $error .= "=> Answer 1 is empty <br>";
        //     }
        //     if (empty($answer_2)) {
        //         $form = false;
        //         $error .= "=> Answer 2 is empty <br>";
        //     }
        //     if (empty($answer_3)) {
        //         $form = false;
        //         $error .= "=> Answer 3 is empty <br>";
        //     }
        //     if (empty($answer_4)) {
        //         $form = false;
        //         $error .= "=> Answer 4 is empty <br>";
        //     }
        //     if (empty($correct)) {
        //         $form = false;
        //         $error .= "=> Correct option is empty <br>";
        //     }
        //     if (empty($test_category)) {
        //         $form = false;
        //         $error .= "=> Test Category is missing <br>";
        //     }
        //     $quiz_id = escape($_POST['question_id']);

        //     $sql = "SELECT * from question_bank_list where question_title = '$question_title' and id != '$quiz_id' and status = 1";
        //     $r  = query($sql);
        //     confirm($r);
        //     $count = row_count($r);
        //     if ($count > 0) {
        //         $form = false;
        //         $error .= "=> Question Already exist <br>";
        //     }

        // echo "<br>" . $question_title . '<br>';
        // echo "<br>" . $answer_1 . '<br>';
        // echo "<br>" . $answer_2 . '<br>';
        // echo "<br>" . $answer_3 . '<br>';
        // echo "<br>" . $answer_4 . '<br>';
        // echo "<br>" . $correct . '<br>';

        // $resource = escape(implode(',',$_POST['answer_id']));
        // echo "<br>";
        // $ar = explode(',',$resource);
        // echo $ar;
        // if ($form) {
        //     // echo $quiz_id;
        //     $qbl = question_bank_list::sam($quiz_id);
        //     $qbl->question_title = $question_title;
        //     $qbl->category_id = $test_category;
        //     $qbl->quiz_id = $subject_id;
        //     $qbl->type = 'Multiple';
        //     $qbl->status = 1;
        //     $qbl->save();
        //     // $bb = question_bank_list::last_id_search_zero();
        //     // $bbid =  $bb->id;

        //     for ($i = 1; $i <= 4; $i++) {
        //         // echo
        //         $abcd = escape($_POST['answer_id' . $i]);
        //         // echo $resource . '<br>';
        //         // echo "<br>" . $a;
        //         // $k = $z[$i];
        //         $a = escape($_POST['question_answer' . $i]);
        //         // echo "<br>" . $a;
        //         $k = $z[$i];

        //         $qs = question_bank_answer::sam($abcd);
        //         $qs->quiz_id = $quiz_id;
        //         $qs->answer = $a;
        //         $qs->correct = $k;
        //         $qs->points = 1;
        //         $qs->status = 1;
        //         $qs->save();
        //         // if($qs->create()){
        //         echo "success_add";
        //     }
        // } else {
        //     echo $error;
        // }
        return response()->json(['success' => 'question has been Updated']);
    }
    //

}
