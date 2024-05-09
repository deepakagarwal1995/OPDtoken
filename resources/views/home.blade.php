@extends('layouts.app')

@section('content')

<style>
    	.number span {cursor:pointer; }

		.minus, .plus{
			    height: 49px;
    width: 46px;
			background:#f2f2f2;
			border-radius:4px;
			padding:8px 5px 8px 5px;
			border:1px solid #ddd;
      display: inline-block;
      vertical-align: middle;
      text-align: center;
		}
		.number input{
			    height: 49px;
    width: 150px;
      text-align: center;
      font-size: 26px;
			border:1px solid #ddd;
			border-radius:4px;
      display: inline-block;
      vertical-align: middle;
        }

</style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card blockquote blockquote-custom bg-white shadow rounded text-center">
                    <div class="card-header">

                        @if (session('success'))
                             <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  <span aria-hidden="true"></span>
</button>
</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
  <span aria-hidden="true"></span>
</button>
</div>
                        @endif
                    </div>


                    <div class="card-body my-5 text-center">

                        @if ($data->status == 1)


                         <form action="{{ route('update_token') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Current Token Number</label>
                            <div class="number">
	<span class="minus">-</span>
	<input type="number" name="curr_token" value="{{ $data->curr_token }}"  max="999" required=""/>
	<span class="plus">+</span>
</div>



                        </div>


                        <button type="submit" class="btn btn-warning  ">Submit</button>
                        <button type="button" class="btn btn-danger " data-bs-toggle="modal"
                            data-bs-target="#exampleModal1">Stop OPD</button>
                    </form>
@endif
                        @if ($data->status == 0)

                          <form action="{{ route('start_opd') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success btn-lg">START OPD </button>
                    </form>


                        @endif
                    </div>
                    <div class="card-footer">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            Set Average Time
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Average Time Per Token</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('average_time') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Average Time</label>
                            <input type="number" name="avg_time_in_min" value="{{ $data->avg_time_in_min }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required="">
                            <div id="emailHelp" class="form-text">Please insert time in Minutes</div>
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

     <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Stop OPD</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('stop_opd') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Next Start Date</label>
                            <input type="date" name="start_from_date" value="{{ $data->start_from_date }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required="">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Next Start Time</label>
                            <input type="time" name="start_from_time" value="{{ $data->start_from_time }}"
                                class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required="">
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    	$(document).ready(function() {
			$('.minus').click(function () {
				var $input = $(this).parent().find('input');
				var count = parseInt($input.val()) - 1;
				count = count < 1 ? 1 : count;
				$input.val(count);
				$input.change();
				return false;
			});
			$('.plus').click(function () {
				var $input = $(this).parent().find('input');
				$input.val(parseInt($input.val()) + 1);
				$input.change();
				return false;
			});
		});
</script>
