<?php

namespace Tests\Unit;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class EducationalAppTest extends TestCase
{
    use DatabaseTransactions;

    public function test_get_all_students_endpoint()
    {
        $response = $this->getJson('/api/students');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'phone',
                    'email',
                ]
            ]
        ]);
    }


    public function test_create_new_student()
    {
        $response = $this->postJson(
            '/api/students',
            [
                'name' => 'Mohamed Test',
                'email' => 'mtest@test.com',
                'phone' => '01111111111'
            ]
        );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'id'
            ]
        ]);
    }


    public function test_get_student_details_by_id()
    {
        $response = $this->getJson(
            '/api/students/1'
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'phone',
            ]
        ]);
    }

    public function test_update_student_data()
    {
        $response = $this->putJson(
            '/api/students/1',
            [
                'name' => 'Ahmed Test',
                'email' => 'ahmed@test.com',
                'phone' => '01222222222',
            ]
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'phone',
            ]
        ]);
    }


    public function test_get_courses_list()
    {
        $response = $this->getJson(
            '/api/courses'
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                ]
            ]
        ]);
    }

    public function test_get_course_details_by_id()
    {
        $response = $this->getJson(
            '/api/courses/1'
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
            ]
        ]);
    }

    public function test_create_new_course()
    {
        $response = $this->postJson(
            '/api/courses',
            [
                'name' => 'new test course',
            ]
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
            ]
        ]);
    }

    public function test_update_course()
    {
        $response = $this->putJson(
            '/api/courses/1',
            [
                'name' => 'new updated course name',
            ]
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
            ]
        ]);
    }


    public function test_get_all_grades()
    {
        $response = $this->getJson(
            '/api/grades'
        );

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'student_id',
                    'course_id',
                    'grade',
                ]
            ]
        ]);
    }


    public function test_get_grades_for_specific_student_only()
    {
        $response = $this->getJson('/api/students/1/grades');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'student_id',
                    'course_id',
                    'grade',
                ]
            ]
        ]);
    }


    public function test_get_specific_grade_for_specific_student()
    {
        $response = $this->getJson('/api/students/1/grades/1');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                'student_id',
                'course_id',
                'grade',
            ]
        ]);
    }
}
