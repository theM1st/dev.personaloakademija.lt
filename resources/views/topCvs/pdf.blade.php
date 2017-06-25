<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        body { font-family: DejaVu Serif; font-size: 12px; line-height: 16px; }
        .label {
            background-color: #58b397;
            border-radius: 0;
            color: #fff;
            line-height: 1;
            text-align: center;
            vertical-align: baseline;
            white-space: nowrap;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .img-responsive {
            display: block;
            max-width: 100%;
            height: auto;
        }
        .table {
            border-spacing: 0;
            border-collapse: collapse;
            width: 100%;
            max-width: 100%;
            margin-bottom: 20px;
        }
        .table tr td {
            padding: 5px 15px;
        }
        .top-cv-profile {
            position: relative;
        }
        .top-cv-profile h1 {
            font-size: 18px;
            font-weight: normal;
            margin-bottom: 30px;
        }
        .top-cv-profile h1 span {
            font-size: 75%;
        }
        .top-cv-profile .top-block {
            margin-bottom: 0;
        }
        .top-cv-profile .top-block .logo {
            display: inline-block;
            width: 110px;
        }
        .top-cv-profile .top-block .user-info {
            display: inline-block;
        }
        .top-cv-profile .top-block .user-info .col1 {
            border-right: 1px solid #e8e8e8;
            padding: 10px 20px;
            text-align: right;
        }
        .top-cv-profile .top-block .user-info .col2 {
            padding: 10px 20px;
        }
        .top-cv-profile .middle-block {
            margin-bottom: 20px;
        }
        .top-cv-profile h2 {
            font-size: 13px;
            font-weight: bold;
            margin: 10px 0;
            text-align: center;
        }
        .top-cv-profile .table tr td {
            border-top: none;
            padding: 10px;
            vertical-align: middle;
        }
        .top-cv-profile .table tr td.col1 {
            background-color: #e8e8e8;
            font-weight: bold;
            text-align: center;
            width: 150px;
        }
        .top-cv-profile .table tr td.col2 {
            padding-left: 0;
            padding-right: 0;
        }
        .top-cv-profile .table tr td.col2 .label {
            display: block;
            font-size: 12px;
            font-weight: normal;
            margin-top: 2px;
            padding: 3px 6px;
            width: 80%;
        }
        .top-cv-profile .table tr td.col2 .table {
            margin: 0;
        }
        .top-cv-profile .table tr td.col2 .table .separator td {
            border-top: 1px solid #e8e8e8;
        }
        .top-cv-profile .table tr td.col2 .table .separator:first-child td {
            border: none;
        }
        .top-cv-profile .table table .first-language td {
            border-bottom: 1px solid #e8e8e8;
        }
        .top-cv-profile .table tr td.col2 .salary span + span::before {
            content: '/';
        }
        .top-cv-profile .table tr td.col2 .table td.col21 {
            width: 130px;
            white-space:nowrap;
            vertical-align:top
        }
        .top-cv-profile .table table tr td {
            padding: 5px 15px;
        }
        .top-cv-profile .cv-skills tr td.col2 {
            border-bottom: 1px solid #e8e8e8;
            padding: 5px 15px;
        }
        .top-cv-profile .cv-skills tr td.last {
            border: none;
        }
    </style>
</head>
<body>
    <div class="top-cv-profile">
        @include('topCvs.partials.cv', ['pdf' => true])
    </div>
</body>
</html>