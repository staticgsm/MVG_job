<?php
use App\Models\EducationCourse;
echo json_encode(EducationCourse::pluck('name')->toArray());
