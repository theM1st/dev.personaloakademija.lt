<?php

    $data = array();

    $knowledges = array();
    $knowledges[] = array('name_lt' => 'Word', 'position' => 1);
    $knowledges[] = array('name_lt' => 'Excel', 'position' => 2);
    $knowledges[] = array('name_lt' => 'PowerPoint', 'position' => 3);
    $knowledges[] = array('name_lt' => 'Access', 'position' => 4);
    $data[] = array('name_lt' => 'MS Office programinis paketas', 'position' => 1, 'knowledges' => $knowledges);

    $knowledges = array();
    $knowledges[] = array('name_lt' => 'Photoshop', 'position' => 1);
    $knowledges[] = array('name_lt' => 'Coreldraw', 'position' => 2);
    $knowledges[] = array('name_lt' => 'SketchUp', 'position' => 3);
    $knowledges[] = array('name_lt' => 'Pagemaker', 'position' => 4);
    $knowledges[] = array('name_lt' => 'Flash', 'position' => 5);
    $knowledges[] = array('name_lt' => 'Director', 'position' => 6);
    $data[] = array('name_lt' => 'Dizaino ir grafikos projekvimo programos', 'position' => 2, 'knowledges' => $knowledges);

    $knowledges = array();
    $knowledges[] = array('name_lt' => 'Agnum', 'position' => 1);
    $knowledges[] = array('name_lt' => 'Debetas', 'position' => 2);
    $knowledges[] = array('name_lt' => 'Finvalda', 'position' => 3);
    $knowledges[] = array('name_lt' => 'Hansa', 'position' => 4);
    $knowledges[] = array('name_lt' => 'Labbis', 'position' => 5);
    $knowledges[] = array('name_lt' => 'Navision', 'position' => 6);
    $knowledges[] = array('name_lt' => 'Pragma', 'position' => 7);
    $knowledges[] = array('name_lt' => 'Rivilė', 'position' => 8);
    $knowledges[] = array('name_lt' => 'SAP', 'position' => 9);
    $knowledges[] = array('name_lt' => 'Scala', 'position' => 10);
    $knowledges[] = array('name_lt' => 'Skaita', 'position' => 11);
    $knowledges[] = array('name_lt' => 'Stekas', 'position' => 12);
    $data[] = array('name_lt' => 'Apskaitos programos', 'position' => 3, 'knowledges' => $knowledges);

    $knowledges = array();
    $knowledges[] = array('name_lt' => 'Sistela', 'position' => 1);
    $knowledges[] = array('name_lt' => 'STAAD Pro', 'position' => 2);
    $knowledges[] = array('name_lt' => 'AutoCAD', 'position' => 3);
    $knowledges[] = array('name_lt' => 'MathCad', 'position' => 4);
    $knowledges[] = array('name_lt' => 'Robot structural', 'position' => 5);
    $knowledges[] = array('name_lt' => 'ProSama', 'position' => 6);
    $knowledges[] = array('name_lt' => 'SES', 'position' => 7);
    $data[] = array('name_lt' => 'Statybų srities projektavimo programos', 'position' => 4, 'knowledges' => $knowledges);

    $knowledges = array();
    $knowledges[] = array('name_lt' => 'ASP.NET', 'position' => 1);
    $knowledges[] = array('name_lt' => 'C#', 'position' => 2);
    $knowledges[] = array('name_lt' => 'C++', 'position' => 3);
    $knowledges[] = array('name_lt' => 'CSS', 'position' => 4);
    $knowledges[] = array('name_lt' => 'HTML', 'position' => 5);
    $knowledges[] = array('name_lt' => 'Java', 'position' => 6);
    $knowledges[] = array('name_lt' => 'JavaScript', 'position' => 7);
    $knowledges[] = array('name_lt' => '.NET', 'position' => 8);
    $knowledges[] = array('name_lt' => 'Objective-C', 'position' => 9);
    $knowledges[] = array('name_lt' => 'Pascal', 'position' => 10);
    $knowledges[] = array('name_lt' => 'Perl', 'position' => 11);
    $knowledges[] = array('name_lt' => 'PHP', 'position' => 12);
    $knowledges[] = array('name_lt' => 'Python', 'position' => 13);
    $knowledges[] = array('name_lt' => 'Ruby', 'position' => 14);
    $knowledges[] = array('name_lt' => 'VBScript', 'position' => 15);
    $knowledges[] = array('name_lt' => 'Visual Basic', 'position' => 16);
    $knowledges[] = array('name_lt' => 'WAP', 'position' => 17);
    $knowledges[] = array('name_lt' => 'XML', 'position' => 18);
    $data[] = array('name_lt' => 'Programavimo kalbos', 'position' => 5, 'knowledges' => $knowledges);

    $knowledges = array();
    $knowledges[] = array('name_lt' => 'Linux', 'position' => 1);
    $knowledges[] = array('name_lt' => 'Mac OS X', 'position' => 2);
    $knowledges[] = array('name_lt' => 'Novell netware', 'position' => 3);
    $knowledges[] = array('name_lt' => 'Unix', 'position' => 4);
    $knowledges[] = array('name_lt' => 'Windows', 'position' => 5);
    $knowledges[] = array('name_lt' => 'Windows Mobile', 'position' => 6);
    $knowledges[] = array('name_lt' => 'BlackBerry', 'position' => 7);
    $knowledges[] = array('name_lt' => 'iPhone', 'position' => 8);
    $data[] = array('name_lt' => 'Operacinės sistemos', 'position' => 6, 'knowledges' => $knowledges);

    $knowledges = array();
    $knowledges[] = array('name_lt' => 'Android', 'position' => 1);
    $knowledges[] = array('name_lt' => 'iOS', 'position' => 2);
    $knowledges[] = array('name_lt' => 'Symbian', 'position' => 3);
    $knowledges[] = array('name_lt' => 'BREW', 'position' => 4);
    $data[] = array('name_lt' => 'Atviro kodo operacinės sistemos ir platformos', 'position' => 7, 'knowledges' => $knowledges);

    $knowledges = array();
    $knowledges[] = array('name_lt' => 'Amazon SimpleDB', 'position' => 1);
    $knowledges[] = array('name_lt' => 'Clarion', 'position' => 2);
    $knowledges[] = array('name_lt' => 'DB2', 'position' => 3);
    $knowledges[] = array('name_lt' => 'dBase', 'position' => 4);
    $knowledges[] = array('name_lt' => 'Foxpro', 'position' => 4);
    $knowledges[] = array('name_lt' => 'Informix', 'position' => 4);
    $knowledges[] = array('name_lt' => 'MS Sql', 'position' => 4);
    $knowledges[] = array('name_lt' => 'MySql', 'position' => 4);
    $knowledges[] = array('name_lt' => 'NoSQL', 'position' => 4);
    $knowledges[] = array('name_lt' => 'Oracle', 'position' => 4);
    $knowledges[] = array('name_lt' => 'Paradox', 'position' => 4);
    $knowledges[] = array('name_lt' => 'Sybase', 'position' => 4);
    $data[] = array('name_lt' => 'Duomenų bazės', 'position' => 8, 'knowledges' => $knowledges);

    return $data;



















































