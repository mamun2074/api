<?php

return [

    'response' => [
        'add'    => [
            'code'    => 'A01',
            'message' => 'Item added successfully!'
        ],
        'update'    => [
            'code'    => 'U01',
            'message' => 'Item updated successfully!'
        ],
        'remove' => [
            'code'    => 'R01',
            'message' => 'Item removed successfully!'
        ],
        'status' => [
            'code'    => 'Z01',
            'message' => 'Status updated!'
        ],
        'success' => [
            'code'    => 'S01',
            'message' => 'Successfully Done!'
        ],
        'not_found' => [
            'code'    => 'N01',
            'message' => 'Not Found!'
        ],
        'not_active' => [
            'code'    => 'N02',
            'message' => 'Not Active!'
        ],
        'email' => [
            'already_verified' => [
                'code'    => 'V01',
                'message' => 'Already Verified!'
            ],
            'verify_email' => [
                'code'    => 'V02',
                'message' => 'Verify Email Send'
            ],
        ],
        'error' => [
            'code'    => 'E01',
            'message' => 'Whoops, looks like something went wrong! Please try again.',
        ],
        'login' => [
            'inactive' => [
                'code'    => 'L01',
                'message' => 'User is inactive'
            ],
            'invalid' => [
                'code'    => 'L02',
                'message' => 'Wrong email or password!'
            ],
            'not_verified' => [
                'code'    => 'L03',
                'message' => 'User is not verified'
            ],
            'verify_email' => [
                'code'    => 'L04',
                'message' => 'Email Send for Verification'
            ],
        ],
        'validation_error' => [
            'code'    => 'E02',
            'message' => 'Validation Error.'
        ],
        'logout' => [
            'code'    => 'L01',
            'message' => 'Logout Successfully'
        ],
        'register' => [
            'verify_email' => [
                'code'    => 'A02',
                'message' => 'Register Successfully! Verify Email Send'
            ]
        ],
        'unauthorized' => [
            'code'    => 'U01',
            'message' => 'Unauthorized Access.'
        ],
    ],
];
