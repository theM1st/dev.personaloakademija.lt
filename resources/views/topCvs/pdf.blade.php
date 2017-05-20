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
        .table {
            width: 100%;
        }
        .table tr td {
            padding: 5px 15px;
        }
        .top-cv-profile .top-block {
            margin-bottom: 20px;
        }
        .top-cv-profile .top-block .cv-id {
            border: 1px solid #e8e8e8;
            color: #002060;
            font-size: 12px;
            font-weight: normal;
            padding: 4px 10px;
        }
        .top-cv-profile .top-block .table tr td.col1 {
            background-color: transparent;
            width: 150px;
        }
        .top-cv-profile .top-block .table tr td.col2 {
        }
        .top-cv-profile .top-block .table tr td.col3 {
        }
        .top-cv-profile .top-block .table tr td.col2 .table .sub-col1 {
            border-right: 1px solid #e8e8e8;
            text-align: right;
            width: 50%;
        }
        .top-cv-profile .top-block .table tr td.col2 .table .sub-col2 {
            text-align: left;
            width: 50%;
        }
        .top-cv-profile .top-block .cv-tags .t {
            font-weight: bold;
            margin: 5px 0;
        }
        .top-cv-profile .top-block .cv-tags span {
            display: block;
            text-align: left;
            width: 100%;
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
            font-size: 100%;
            font-weight: normal;
            margin-top: 2px;
            padding: 3px 6px;
        }
        .top-cv-profile .table tr td.col2 .table {
            margin: 0;
        }
        .top-cv-profile .table tr td.col2 .table .separator {
            border-top: 1px solid #e8e8e8;
        }
        .top-cv-profile .table tr td.col2 .table .separator:first-child {
            border: none;
        }
        .top-cv-profile .table table .foreign-language-title td {
            border-top: 1px solid #e8e8e8;
        }
        .top-cv-profile .table tr td.col2 .salary span + span::before {
            content: '/';
        }
        .top-cv-profile .table table tr td {
            padding: 5px 15px;
        }
    </style>
</head>
<body>
    <div class="top-cv-profile">
        @include('topCvs.partials.cv')
    </div>
</body>
</html>