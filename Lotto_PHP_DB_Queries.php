<?php

return
[# Array of Query Params      
    'SQL_Select_1' =>  [
        'table_name'         =>  'tbl_lottery_numbers',
        'query_2_run'     =>  'SQL_Select_1',
        'results_2_output'=>  'Results_2_Table_1',
        'query_type'    =>  'Select',
        'query_params'  =>  [ # Bind Params
            ':twitter_user'     => 'twitter_user',
            ':draw_date'        => 'draw_date',
            ':draw_type'        => 'draw_type',
            ':entry_submition'  => 'entry_submition',
            ':param_5'          => 'param_5'
        ]
    ],
    'inst_2' =>  [
        'type'      =>  'insert',        
        'params'    =>  [ # Bind Params
            ':param_1' => 'param_1',
            ':param_2' => 'param_2',
            ':param_3' => 'param_3',
            ':param_4' => 'param_4',
            ':param_5' => 'param_5'
        ]
    ],
    'updt_1' =>  [
        'type'      =>  'update',
        'params'    =>  [ # Bind Params
            ':param_1' => 'param_1',
            ':param_2' => 'param_2',
            ':param_3' => 'param_3',
            ':param_4' => 'param_4',
            ':param_5' => 'param_5'
        ]
    ],
    'updt_2' =>  [
        'type'      =>  'update',
        'params'    =>  [ # Bind Params
            ':param_1' => 'param_1',
            ':param_2' => 'param_2',
            ':param_3' => 'param_3',
            ':param_4' => 'param_4',
            ':param_5' => 'param_5'
        ]
    ],
    'dlt_1' =>  [
        'type'      =>  'delete',
        'params'    =>  [ # Bind Params
            ':param_1' => 'param_1',
            ':param_2' => 'param_2',
            ':param_3' => 'param_3',
            ':param_4' => 'param_4',
            ':param_5' => 'param_5'
        ]
    ],
    'dlt_2' =>  [
        'type'      =>  'delete',
        'params'    =>  [ # Bind Params
            ':param_1' => 'param_1',
            ':param_2' => 'param_2',
            ':param_3' => 'param_3',
            ':param_4' => 'param_4',
            ':param_5' => 'param_5'
        ]
    ],
    'slt_1' =>  [
        'type'      =>  'select',
        'params'    =>  [ # Bind Params
            ':param_1' => 'param_1',
            ':param_2' => 'param_2',
            ':param_3' => 'param_3',
            ':param_4' => 'param_4',
            ':param_5' => 'param_5'
        ]
    ],
    'slt_2' =>  [
        'type'      =>  'select',
        'params'    =>  [ # Bind Params
            ':param_1' => 'param_1',
            ':param_2' => 'param_2',
            ':param_3' => 'param_3',
            ':param_4' => 'param_4',
            ':param_5' => 'param_5'
        ]
    ],
];
?>