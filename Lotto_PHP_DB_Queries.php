<?php

return
    [# Array of Query Params      
        'sql_Input_TwitterUser'  => [
            'queries2run'   => [
                'Select' => True,
                'Insert' => True,
                'Update' => False
            ],
            'query_select'  => [
                    'query' => 'SELECT twitter_user 
                                FROM tbl_Lottery_Users 
                                WHERE twitter_user=:lotto_twitter_user_name',
                    'params'=> ['lotto_twitter_user_name']

            ],
            'query_insert'  => [
                'query' => 'INSERT INTO tbl_Lottery_Users (twitter_user, reg_date, ip_address) 
                            VALUES (:lotto_twitter_user_name, :lotto_reg_date,:lotto_ip_address)',
                'params'=> ['lotto_twitter_user_name', 'lotto_reg_date', 'lotto_ip_address']
            ],
            'query_update'  => [
                'query' => 'UPDATE tbl_Lottery_Users
                            SET twitter_user =:lotto_twitter_user_name                           
                            WHERE ip_address =:lotto_ip_address',
                'params'=> ['lotto_twitter_user_name','lotto_ip_address']
            ]
        ],
        'sql_Input_DrawDate'     => [
            'queries2run'   => [
                'Select' => True,
                'Insert' => True,
                'Update' => False
            ],
            'query_select'  => [
                'query' => 'SELECT draw_date
                            FROM tbl_Lottery_Draws
                            WHERE draw_date=:lotto_draw_date
                            AND draw_type=:lotto_draw_type',
                'params'=> ['lotto_draw_date','lotto_draw_type']
            ],
            'query_insert'  => [
                'query' => 'INSERT INTO tbl_Lottery_Draws (draw_date, draw_type)
                            VALUES (:lotto_draw_date, :lotto_draw_type)',
                'params'=> ['lotto_draw_date','lotto_draw_type']
            ],
            'query_update'  => [
                'query' => 'UPDATE tbl_Lottery_Draws
                            SET balls_signature =:lotto_balls_signature                           
                            WHERE draw_date =:lotto_draw_date
                            AND draw_type =:lotto_draw_type',
                'params'=> ['lotto_draw_date','lotto_draw_type','lotto_balls_signature']
            ]
        ],
        'sql_Input_DrawType'     => [
            'queries2run'   => [
                'Select' => True,
                'Insert' => True,
                'Update' => False
            ],
            'query_select'  => [
                'query' => 'SELECT draw_type
                            FROM tbl_Lottery_Draws
                            WHERE draw_date=:lotto_draw_date
                            AND draw_type=:lotto_draw_type',
                'params'=> ['lotto_draw_date','lotto_draw_type']
            ],
            'query_insert'  => [
                'query' => 'INSERT INTO tbl_Lottery_Draws (draw_date, draw_type)
                            VALUES (:lotto_draw_date, :lotto_draw_type)',
                'params'=> ['lotto_draw_date','lotto_draw_type']
            ],
            'query_update'  => [
                'query' => 'UPDATE tbl_Lottery_Draws
                            SET balls_signature =:lotto_balls_signature                           
                            WHERE draw_date =:lotto_draw_date
                            AND draw_type =:lotto_draw_type',
                'params'=> ['lotto_draw_date','lotto_draw_type','lotto_balls_signature']
            ]
        ],
        'sql_Input_BallSignature'=> [
            'queries2run'   => [
                'Select' => True,
                'Insert' => True,
                'Update' => True
            ],
            'query_select'  => [
                'query' => 'SELECT twitter_user, draw_date, draw_type, balls_signature, entry_submition
                            FROM tbl_Lottery_Numbers
                            WHERE twitter_user=:lotto_twitter_user_name 
                            AND draw_date=:lotto_draw_date
                            AND draw_type=:lotto_draw_type',
                'params'=> ['lotto_twitter_user_name','lotto_draw_date','lotto_draw_type']
            ],
            'query_insert'  => [
                'query' => 'INSERT INTO tbl_Lottery_Numbers (twitter_user, draw_date, draw_type, balls_signature, entry_submition)
                            VALUES (:lotto_twitter_user_name, :lotto_draw_date, :lotto_draw_type, :lotto_balls_signature :lotto_submit_entry)',
                'params'=> ['lotto_twitter_user_name', 'lotto_draw_date', 'lotto_draw_type', 'lotto_balls_signature', 'lotto_submit_entry']
            ],
            'query_update'  => [
                'query' => 'UPDATE tbl_Lottery_Numbers
                            SET balls_signature =:lotto_balls_signature 
                            WHERE draw_date =:lotto_draw_date
                            AND draw_type =:lotto_draw_type',
                'params'=> ['lotto_balls_signature','lotto_draw_date','lotto_draw_type']
            ]
        ],
        'sql_Input_SubmitAll'    => [
            'queries2run'   => [
                'Select' => True,
                'Insert' => True,
                'Update' => False
            ],
            'query_select'  => [
                'query' => 'SELECT twitter_user, draw_date, draw_type, balls_signature, entry_submition
                            FROM tbl_Lottery_Numbers
                            WHERE twitter_user=:lotto_twitter_user_name 
                            AND draw_date=:lotto_draw_date
                            AND draw_type=:lotto_draw_type
                            AND balls_signature=:lotto_balls_signature',
                'params'=> ['lotto_twitter_user_name','lotto_draw_date','lotto_draw_type','lotto_balls_signature']
            ],
            'query_insert'  => [
                'query' => 'INSERT INTO tbl_Lottery_Numbers (twitter_user, draw_date, draw_type, balls_signature, entry_submition)
                            VALUES (:lotto_twitter_user_name, :lotto_draw_date, :lotto_draw_type, :lotto_balls_signature, :lotto_submit_entry)',
                'params'=> ['lotto_twitter_user_name','lotto_draw_date','lotto_draw_type','lotto_balls_signature','lotto_submit_entry']
            ],
            'query_update'  => [
                'query' => 'UPDATE tbl_Lottery_Numbers
                            SET balls_signature =:lotto_balls_signature, entry_submition=:lotto_submit_entry 
                            WHERE twitter_user=:lotto_twitter_user_name
                            AND draw_date =:lotto_draw_date
                            AND draw_type =:lotto_draw_type',
                'params'=> ['lotto_twitter_user_name','lotto_draw_date','lotto_draw_type','lotto_balls_signature','lotto_submit_entry']
            ]
        ],
        'sql_Input_Template'     => [
            'queries2run'   => [
                'Select' => True,
                'Insert' => True,
                'Update' => False
            ],      
            'query_select'  => [
                'query' => 'SELECT column1, column2
                            FROM tbl_TableName
                            WHERE column1=:column1_par 
                            AND column2=:column2_par',
                'params'=> ['column1_par','column2_par']
            ],
            'query_insert'  => [
                'query' => 'INSERT INTO tbl_TableName (column1, column2)
                            VALUES (:column1_par, :column2_par)',
                'params'=> ['column1_par', 'column2_par']
            ],
            'query_update'  => [
                'query' => 'UPDATE tbl_TableName
                            SET column1 =:column1_par, column2=:column2_par 
                            WHERE column1=:column1_par
                            AND column2 =:column2_par',
                'params'=> ['column1_par', 'column2_par']
            ]
        ]
    ];
?>