<div class="modal fade" id="deposit-modal-{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="border-radius:1px">

            <div class="modal-header row" style="height:75px;margin:0px;">
                <div class="modal-title col-md-10 col-xs-10" id="modalLabel"><h4>Make a Deposit</h4></div>

                <div class="col-md-1 col-xs-2">
                    <button type="button" class="close" data-dismiss="modal">&times</button>
                </div>
            </div>
            {{ Form::open([ 'url'=>['/items/'.$item->id.'/layaway'], 'method'=>'POST']) }}
            <div class="modal-body">
                <div class="alert alert-warning">
                    <h5><i class="glyphicon glyphicon-warning-sign"></i> Important</h5>
                    <p>
                        Any amount you deposit will add on top of the current deposit.
                        For a first time Deposit, the depositor field will be available otherwise it will not.
                    </p>
                </div>

                <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                    {!! Form::label('amount','Amount :') !!}
                    <input type="hidden" id="code" name="code" value="{{$value->code}}"/>
                    <input type="number" id="amount" name="amount" class="form-control"/>

                    @if ($errors->has('amount'))
                        <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                        </span>
                    @endif
                </div>

                @if($value->status == "Available")
                    <div class="form-group{{ $errors->has('depositor') ? ' has-error' : '' }}">
                        {!! Form::label('depositor','Deposited By:') !!}
                        <input type="text" id="depositor" name="depositor" class="form-control" required/>

                        @if ($errors->has('depositor'))
                            <span class="help-block">
                            <strong>{{ $errors->first('depositor') }}</strong>
                        </span>
                        @endif
                    </div>
                @endif
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Proceed</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
