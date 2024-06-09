<?php
$db_object = [
    'students' => [
        ['name' => 'StudentID', 'type' => 'INT', 'unique' => true, 'hidden' => true, 'label' => 'Student ID', 'required' => true],
        ['name' => 'FirstName', 'type' => 'VARCHAR(50)', 'label' => 'First Name', 'required' => true],
        ['name' => 'LastName', 'type' => 'VARCHAR(50)', 'label' => 'Last Name', 'required' => true],
        ['name' => 'DateOfBirth', 'type' => 'DATE', 'label' => 'Date of Birth', 'required' => true],
        ['name' => 'Address', 'type' => 'VARCHAR(100)', 'label' => 'Address', 'required' => true],
        ['name' => 'PhoneNumber', 'type' => 'VARCHAR(15)', 'label' => 'Phone Number', 'required' => true],
        ['name' => 'Email', 'type' => 'VARCHAR(50)', 'label' => 'Email', 'required' => true]
    ],
    'teachers' => [
        ['name' => 'TeacherID', 'type' => 'INT', 'unique' => true, 'hidden' => true, 'label' => 'Teacher ID', 'required' => true],
        ['name' => 'FirstName', 'type' => 'VARCHAR(50)', 'label' => 'First Name', 'required' => true],
        ['name' => 'LastName', 'type' => 'VARCHAR(50)', 'label' => 'Last Name', 'required' => true],
        ['name' => 'DateOfBirth', 'type' => 'DATE', 'label' => 'Date of Birth', 'required' => true],
        ['name' => 'Address', 'type' => 'VARCHAR(100)', 'label' => 'Address', 'required' => true],
        ['name' => 'PhoneNumber', 'type' => 'VARCHAR(15)', 'label' => 'Phone Number', 'required' => true],
        ['name' => 'Email', 'type' => 'VARCHAR(50)', 'label' => 'Email', 'required' => true]
    ],
    /*'courses' => [
        ['name' => 'CourseID', 'type' => 'INT', 'unique' => true, 'hidden' => true, 'label' => 'Course ID', 'required' => true],
        ['name' => 'CourseName', 'type' => 'VARCHAR(100)', 'label' => 'Course Name', 'required' => true],
        ['name' => 'Description', 'type' => 'TEXT', 'label' => 'Description', 'required' => false],
        ['name' => 'TeacherID', 'type' => 'INT', 'label' => 'Teacher ID', 'required' => true]
    ],*/
    /*'enrollments' => [
        ['name' => 'EnrollmentID', 'type' => 'INT', 'unique' => true, 'hidden' => true, 'label' => 'Enrollment ID', 'required' => true],
        ['name' => 'StudentID', 'type' => 'INT', 'label' => 'Student ID', 'required' => true],
        ['name' => 'CourseID', 'type' => 'INT', 'label' => 'Course ID', 'required' => true],
        ['name' => 'EnrollmentDate', 'type' => 'DATE', 'label' => 'Enrollment Date', 'required' => true]
    ],*/
    /*'grades' => [
        ['name' => 'GradeID', 'type' => 'INT', 'unique' => true, 'hidden' => true, 'label' => 'Grade ID', 'required' => true],
        ['name' => 'EnrollmentID', 'type' => 'INT', 'label' => 'Enrollment ID', 'required' => true],
        ['name' => 'Grade', 'type' => 'CHAR(2)', 'label' => 'Grade', 'required' => true],
        ['name' => 'GradeDate', 'type' => 'DATE', 'label' => 'Grade Date', 'required' => true]
    ],*/
    'fees' => [
        ['name' => 'FeeID', 'type' => 'INT', 'unique' => true, 'hidden' => true, 'label' => 'Fee ID', 'required' => true],
        ['name' => 'FeeName', 'type' => 'VARCHAR(50)', 'label' => 'Fee Name', 'required' => true],
        ['name' => 'Amount', 'type' => 'DECIMAL(10, 2)', 'label' => 'Amount', 'required' => true],
        ['name' => 'DueDate', 'type' => 'DATE', 'label' => 'Due Date', 'required' => true]
    ],
    'payments' => [
        ['name' => 'PaymentID', 'type' => 'INT', 'unique' => true, 'hidden' => true, 'label' => 'Payment ID', 'required' => true],
        ['name' => 'StudentID', 'type' => 'INT', 'label' => 'Student ID', 'required' => true],
        ['name' => 'FeeID', 'type' => 'INT', 'label' => 'Fee ID', 'required' => true],
        ['name' => 'AmountPaid', 'type' => 'DECIMAL(10, 2)', 'label' => 'Amount Paid', 'required' => true],
        ['name' => 'PaymentDate', 'type' => 'DATE', 'label' => 'Payment Date', 'required' => true]
    ]
];
?>
