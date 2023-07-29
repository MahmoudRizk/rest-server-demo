<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;


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