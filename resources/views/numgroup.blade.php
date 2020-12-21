@extends('layouts.masterregis')
@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-sm bg-lightgray">
            <div class="section px-lg-5 px-3">
                <div class="top-border left"></div>
                <div class="top-border right"></div>
                <h2 class="mb-5">GROUP REGISTER</h2>
                <form class="text-left" action="{{  url('Registration') }}" method="post">
                    @csrf
                    <h4 class="font-weight-bold">Number of people to register</h4>
                    <div class="form-row mt-5">
                        <div class="form-group col-md-12">
                            <label for="number_personal">Choose: </label>
                            <select type="text" class="form-control" id="number_personal" name="number_personal">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                                <option>13</option>
                                <option>14</option>
                                <option>15</option>
                                <option>16</option>
                                <option>17</option>
                                <option>18</option>
                                <option>19</option>
                                <option>20</option>
                            </select>
                        </div>
                    </div>
                    @if (isset($status))
                        @if ($status == 1)
                            <label for="number_personal">Type of Person: </label>
                            <select name="type_personal" id="type_personal" class="form-control" required>
                                <option value="">------ Please Choose Type of Person -------</option>
                                @php
                                    $typepersonals = App\TypePersonal::all();
                                @endphp
                                @foreach ($typepersonals as $typepersonal)
                                    <option value="{{ $typepersonal->tps_id }}">{{ $typepersonal->tps_name }}</option>
                                @endforeach
                               
                            </select>
                        @endif
                    @endif
                    <div class="form-group text-center py-5">
                        <input type="hidden" name="id" id="id" value="{{ $id }}"/>
                        <input type="hidden" name="status" id="status" value="{{ $status }}">
                        <input type="hidden" name="type" id="type" value="{{ $type  }}">
                        
                        <button type="submit" class="btn btn-lg btn-outline-warning">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
