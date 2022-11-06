<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogList</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        input[type='date']::-webkit-calendar-picker-indicator {
            font-size: 2em;
            position: absolute;

        }

        input[type='time']::-webkit-calendar-picker-indicator {
            font-size: 2em;

        }

        input[type='date']::-webkit-datetime-edit {
            text-align: center;
        }

        input[type='date']:focus {
            outline: none;
        }

        input[type='time']:focus {
            outline: none;
        }

    </style>
</head>

<body>
    <div style="width:100%;height:8vh;display:flex;justify-content:space-between;background-color:#34495E;">
        <div style="width:90%;">
            <form action={{ route('export') }} method="post" style="display: flex;width:100%;height:100%;justify-content:space-between;align-items:center;">
                @csrf
                <div class="mx-3" style="background-color:#fff;width:45%;height:90%;border-radius:10px;display:flex;">
                    <div style="width:60%;height:100%;padding-right:20px;padding-left:10px;position:relative;">
                        <input type="date" name="param1" value={{ \Carbon\Carbon::now()->subMonth() }} style="width:
                        100%;height:100%;border:1px solid #fff;" />
                    </div>
                    <div style="width:40%;height:100%;padding-right:20px;padding-left:10px;position:relative;">
                        <input type="time" step="1" name="time1" value="00:00:00" style="width: 100%;height:100%;border:1px solid #fff;" />
                    </div>
                </div>
                <div class="mx-3" style="background-color:#fff;width:45%;height:90%;border-radius:10px;display:flex;">
                    <div style="width:100%;height:100%;padding-right:20px;padding-left:10px;position:relative;">
                        <input type="date" name="param2" value={{ \Carbon\Carbon::now() }} style="width: 100%;height:100%;border:1px solid #fff;" />
                    </div>
                    <div style="width:40%;height:100%;padding-right:20px;padding-left:10px;position:relative;">
                        <input type="time" step="1" name="time2" value="00:00:00" style="width: 100%;height:100%;border:1px solid #fff;" />
                    </div>
                </div>
                <div class="mx-2" style="width:12%;height:87%;"><button style="width:100%;height:100%;font-size:1.5em;" type="submit" class="btn btn-primary">Export</button></div>
            </form>
        </div>
        <div style="width:10%;display:flex;align-items:center;">
            <a class="btn btn-danger" href="{{ route('log') }}" style="height: 87%;width:95%;display:flex;align-items:center;justify-content:center;font-size:1.5em;">
                Logout
            </a>
        </div>
    </div>
    <div style="width:100%;height:10vh;display:flex;justify-content:center;align-items:center;">
        <form action="{{ route('filterbyday') }}" method="GET" style="width:40%;height:60%;display: flex;">
            <select class="form-select form-select-lg" aria-label=".form-select-lg example" name="day" style="width:50%;">

                <?php if ($__CURRENT__DATE != 'First Page'){ ?>
                <a>
                    <option value='First Page'>First Page</option>
                </a>
                <?php } ?>
                <option value={{ $__CURRENT__DATE }} selected>{{ $__CURRENT__DATE }}</option>
                @foreach ($__DAYS__CATE as $__ITEM__)
                <a>
                    <?php  if($__ITEM__ != $__CURRENT__DATE){ ?>
                    <option value="{{ $__ITEM__ }}">{{ $__ITEM__ }}</option>
                    <?php } ?>
                </a>
                @endforeach
            </select>
            <div style="height:100%;width:50%;" class="mx-2">
                <button style="height:100%;width:100%;" type="submit" class="btn btn-outline-primary">Filter List By
                    Day</button>
            </div>
        </form>
    </div>
    <div class="mx-5 my-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">ip address</th>
                    <th scope="col">Request</th>
                    <th scope="col">Database ID</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                    {{-- <th scope="col">Response</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($__DATA__FILTER as $__ITEM)
                <tr>
                    <th scope="row">{{ $__ITEM->id }}</th>
                    <td>{{ $__ITEM->IP }}</td>
                    <td>{{ $__ITEM->requestName }}</td>
                    <td>{{ $__ITEM->id }}</td>
                    <td>{{ $__ITEM->status }}</td>
                    <td>{{ $__ITEM->created_at->format('m-d-Y H:i:s A') }}</td>
                    {{-- <td>
                        <a href="{{ route('downloadResponse',['id'=>$item->id]) }}">
                    <button type="button" class="btn btn-success">Download</button>
                    </a>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="width:100%;h-[50px];display:flex;justify-content:center;aling-items:center;margin-top:7px;">
        <div style="width: 100%;display: flex;justify-content: center;align-items: center;">
            <div style="flex:1;display: flex;justify-content: end;height: 100%;align-items: center;margin-top: 10px;">
                {{ $__DATA__FILTER->withQueryString()->links('pagination::bootstrap-4') }}</div>
            <div style="flex:1;display: flex;justify-content:end;margin-right: 7vw;">Page
                {{ $__DATA__FILTER->currentPage() }} of {{ $__DATA__FILTER->lastPage() }} &nbsp;(&nbsp;total
                Request&nbsp;:&nbsp;{{ $__ID__COUNTER }})</div>
        </div>
    </div>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
</body>

</html>
