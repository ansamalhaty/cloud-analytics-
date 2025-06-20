<!DOCTYPE html>
<html dir="rtl" lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة المستندات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .section {
            margin-bottom: 25px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .btn {
            display: inline-block;
            padding: 8px 15px;
            background: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            border: none;
            cursor: pointer;
        }
        .btn-check {
            background: #2196F3;
        }
        .btn-filter {
            background: #9C27B0;
        }
        .file-list {
            list-style: none;
            padding: 0;
            margin-top: 10px;
        }
        .file-list li {
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        .exists {
            background: #FFEBEE;
            border-left: 4px solid #F44336;
            padding: 10px;
            margin-top: 10px;
        }
        .new {
            background: #E8F5E9;
            border-left: 4px solid #4CAF50;
            padding: 10px;
            margin-top: 10px;
        }
        .success {
            color: #4CAF50;
            padding: 10px;
            margin-top: 10px;
        }
        select, input[type="file"] {
            padding: 8px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; color: #333;">نظام إدارة المستندات</h1>

        <!-- قسم التحقق من الملف -->
        <div class="section">
            <h3>التحقق من الملف:</h3>
            <form method="POST" action="{{ route('check.file') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="check_file" accept=".pdf,.docx" required>
                <button type="submit" class="btn btn-check">تحقق من الملف</button>
            </form>

            @if(session('checkResult'))
                @if(session('checkResult.exists'))
                    <div class="exists">
                        <strong>⛔ الملف موجود مسبقاً</strong><br>
                        الاسم: {{ session('checkResult.file_info')->name }}<br>
                        النوع: {{ session('checkResult.file_info')->file_type }}<br>
                        تاريخ الرفع: {{ session('checkResult.file_info')->created_at->format('Y-m-d') }}
                    </div>
                @else
                    <div class="new">✅ هذا ملف جديد</div>
                @endif
            @endif
        </div>

        <!-- قسم تصفية الملفات -->
        <div class="section">
            <h3>تصفية الملفات حسب النوع:</h3>
            <form method="GET" action="{{ route('filter.files') }}">
                <select name="filter_type" required>
                    <option value="">-- اختر النوع --</option>
                    <option value="pdf" {{ $selectedType == 'pdf' ? 'selected' : '' }}>PDF</option>
                    <option value="docx" {{ $selectedType == 'docx' ? 'selected' : '' }}>DOCX</option>
                </select>
                <button type="submit" class="btn btn-filter">عرض الملفات</button>
            </form>

            @if(isset($filterResults))
                <h4 style="margin-top: 15px;">الملفات من نوع {{ strtoupper($selectedType) }}:</h4>
                <ul class="file-list">
                    @foreach($filterResults as $file)
                        <li>{{ $file->name }} ({{ $file->created_at->format('Y-m-d') }})</li>
                    @endforeach
                </ul>
            @elseif(isset($filterResults))
                <p style="margin-top: 10px;">لا توجد ملفات من هذا النوع</p>
            @endif
        </div>

        <!-- قسم رفع الملف -->
        <div class="section">
            <h3>رفع ملف جديد:</h3>
            <form method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="document" accept=".pdf,.docx" required>
                <button type="submit" class="btn">رفع الملف</button>
            </form>
            @if(session('success'))
                <div class="success">{{ session('success') }}</div>
            @endif
        </div>
    </div>
</body>
</html>