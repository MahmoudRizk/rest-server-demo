<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;


// FOR SIMPLICITY WE WON'T IMPLEMENT DELETE OPERATIONS.

/*
 * TODO: Get all students list. ALREADY IMPLEMENTED IN THE DEMO SESSION.
 * URL: GET /students
 * Response:
     Status code: 200
     JSON body: 
         { 
           "data": [    
              { 
                "id": "student_id",
                "name": "student_name",
                "email": "student_email",
                "phone": "student_phone"
              },
              { 
                "id": "student_id",
                "name": "student_name",
                "email": "student_email",
                "phone": "student_phone"
              }
           ]
        }
 */
Route::get('/students', function (Request $request) {
    Log::info('Getting all students');
    
    $rawData = DB::select(DB::raw("select id, name, email, phone from students"));

    $responseData = [];

    foreach ($rawData as $rd) {
        array_push($responseData, [
            'id' => $rd->id,
            'name' => $rd->name,
            'email' => $rd->email,
            'phone' => $rd->phone,
        ]);
    }

    $statusCode = 200;

    return response()->json([  
            'data' => $responseData
    ], $statusCode);
});


/* 
    * TODO: Create new student.
    * URL: POST /students
    * Request Body:
        {   
            "name": "student_name",
            "email": "student_email",
            "phone": "student_phone"
        }
    * Response:
        status_code: 200
        JSON body: 
            {   
                "data": {   
                    "id": "student_id_from_database"
                }
            }
*/
Route::post('/students', function (Request $request) {  
    $requestData = $request->json();
    
    $studentData = [    
        'name' => $requestData->get('name'),
        'email' => $requestData->get('email'),
        'phone' => $requestData->get('phone'),
    ];

    $id = DB::table('students')->insertGetId($studentData);

    return response()->json(    
        [   
            'data' => [ 
                'id' => $id
            ]
        ],
            200
    );

});

/* 
    * TODO: Get student details by id
    * URL: GET /students/{id}
    * Response:
       * success:
            status_code: 200
            JSON body: 
                { 
                    "data": {
                        "id": "student_id",
                        "name": "student_name",
                        "email": "student_email",
                        "phone": "student_phone"
                    }
                }
       * not found:
            status_code: 404
            JSON body: 
                {   
                    "data": {}
                }
*/
Route::get('/students/{id}', function (Request $request, string $id) {  
    $rawData = DB::select(DB::raw("select * from students where id = $id"));

    if ($rawData) { 
        return response()->json(    
            [   
                'data' => [ 
                    'id' => $rawData[0]->id,
                    'name' => $rawData[0]->name,
                    'email' => $rawData[0]->email,
                    'phone' => $rawData[0]->phone
                ]
            ],
                200
        );
    }

    return response()->json(['data' => []], 404);
});


/*
    * TODO: Update student data
    * URL: PUT /students/{id}
    * Request Body:
        {   
            "name": "new_student_name",
            "email": "new_student_email",
            "phone": "new_student_phone"
        }
    * Response:
        status_code: 200
        JSON body:
            {   
                "data": {   
                    "id": "student_id",
                    "name": "new_student_name",
                    "email": "new_student_email",
                    "phone": "new_student_phone"
                }
            }
 */
Route::put('/students/{id}', function (Request $request, string $id) {  
    $updatedAttributes = [];

    $requestData = $request->json();
    
    if ($requestData->get('name')) {    
        $updatedAttributes['name'] = $requestData->get('name'); 
    }
    if ($requestData->get('email')) {    
        $updatedAttributes['email'] = $requestData->get('email'); 
    }
    if ($requestData->get('phone')) {    
        $updatedAttributes['phone'] = $requestData->get('phone'); 
    }

    $affected = DB::table('students')
                ->where('id', $id)
                ->update($updatedAttributes);

    $updatedStudent = $rawData = DB::select(DB::raw("select * from students where id = $id"));

    return response()->json(    
        [   
            'data' => [ 
                'id' => $rawData[0]->id,
                'name' => $rawData[0]->name,
                'email' => $rawData[0]->email,
                'phone' => $rawData[0]->phone
            ]
        ],
            200
    );
});


 /*
   * TODO: For Courses implement Get, Create & Update endpoints same as students 
   * Get all URL: GET /courses
   * Get course details: GET /courses/{id}
   * Create new course: POST /courses{id}
   * Update course: PUT /courses/{id} 
   * Note: For JSON keys in both the request and response, let's use the same database columns names.
 */


 /*
  * TODO: Get all grades endpoint
  * URL: GET /grades
  * Response:
        status_code: 200
        JSON body: {    
            "data": [   
                {   
                    "student_id": "STUDENT ID"
                    "course_id": "COURSE ID",
                    "grade": "GRADE"
                },
                {   
                    "student_id": "STUDENT ID"
                    "course_id": "COURSE ID",
                    "grade": "GRADE"
                }
            ]
        }
  */
  Route::get('/grades', function (Request $request) {

      $rawData = DB::select(DB::raw('select * from grades;'));

      $responseData = [];

      foreach ($rawData as $rd) {
        array_push($responseData, [
            'id' => $rd->id,
            'course_id' => $rd->course_id,
            'student_id' => $rd->student_id,
            'grade' => $rd->grade,
        ]);
      }

      $statusCode = 200;

      return response()->json([  
            'data' => $responseData
      ], $statusCode);
  });

  /*
   * TODO: Get grades for specific student only.
   * URL: GET /students/{student_id}/grades
   * Response:
        status_code: 200
        JSON body: {    
            "data": [   
                {   
                    "student_id": "STUDENT ID"
                    "course_id": "COURSE ID",
                    "grade": "GRADE"
                },
                {   
                    "student_id": "STUDENT ID"
                    "course_id": "COURSE ID",
                    "grade": "GRADE"
                }
            ]
        }
  */


  /*
   * TODO: Get specific grade for specific student only. Shall return one record only if exists.
   * URL: GET /students/{student_id}/grades/{grade_id}
   * Response:
        status_code: 200
        JSON body: {    
            "data": {   
                "student_id": "STUDENT ID"
                "course_id": "COURSE ID",
                "grade": "GRADE"
            }
        }
  */