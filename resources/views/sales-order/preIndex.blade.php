<div class="form-group-inner" style="margin-right:10px;">
	<div class="row" style="text-align:right !important;direction:rtl !important">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="form-group">
				<label class="">عنوان الفرع</label>
				<input name="" value="{{$row->address ?? ''}}" type="text" class="form-control" placeholder="" style="text-align:right" disabled>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="form-group">
				<label class="">كـــــــود الفرع</label>
				<input name="" value="{{$row->code ?? ''}}" type="text" class="form-control" style="text-align:right" disabled>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="form-group">
				<label class="">إسم الفرع باللغة العربية</label>
				<input name="" type="text" value="{{$row->ar_name ?? ''}}" class="form-control" style="text-align:right" disabled>
			</div>
		</div>
	</div>
</div>
<div class="form-group-inner" style="margin-right:10px;">
	<div class="row" style="text-align:right !important;direction:rtl !important">
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="form-group">
				<label class="">البريد الإلكتروني</label>
				<input name="" type="email" value="{{$row->email ?? ''}}" class="form-control" placeholder="" style="text-align:right" disabled>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="form-group">
				<label class="">رقم التليفون</label>
				<input name="" type="number" value="{{$row->phone ?? ''}}" class="form-control" style="text-align:right" disabled>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="form-group">
				<label class="">إسم الفرع باللغة الإنجليزية</label>
				<input name="" type="text" value="{{$row->en_name ?? ''}}" class="form-control" style="text-align:right" disabled>
			</div>
		</div>
	</div>
</div>
<h3 style="text-align:right">بيانات أوامر البيع</h3>
<table class="table-striped" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
	<thead>
		<tr>
			<th data-field="state" data-checkbox="false"></th>
			<th data-field="id">رقم أمر البيع</th>
			<th>تاريخ أمر البيع</th>
			<th>إسم العميل</th>
			<th>وصف أمر البيع</th>
			<th>حالة أمر البيع</th>
			<th>قيمة أمر البيع</th>
			<th>حالة قرار الطلب</th>
			<th>إسم الفرع</th>
			<th>الاختيارات</th>
		</tr>
	</thead>
	<tbody>
		@foreach($orders as $index=>$order)
		<tr>
			<td></td>
			<td>{{$index+1}}</td>
			<td>
			<?php
             $date = date_create($order->order_date) ?>
                {{ date_format($date,"d-m-Y") }}
			</td>
			<td>{{$order->person_name}}</td>
			<td>{{$order->order_description}}</td>
			<td>{{$order->status->ar_name ?? ''}}  </td>
			<td>{{$order->order_value}}</td>
			<td> {{$order->decision->ar_name ?? ''}}</td>
			<td>{{$order->branch->ar_name ?? ''}}</td>
			<td>
				<div class="product-buttons">
					<!-- <button data-toggle="tooltip" title="View" class="pd-setting-ed"><i class="fa fa-file" aria-hidden="true"></i></button> -->
					<a  href="{{ route('sales-order.show',$order->id)}}"><button title="view" class="pd-setting-ed"><i class="fa fa-file" aria-hidden="true"></i></button></a>

					<a @if($order->confirmed == 1) class="isDisabled" @endif href="{{ route('sales-order.edit',$order->id)}}"><button title="Edit" class="pd-setting-ed"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>
					<button @if($order->confirmed == 1) class="isDisabled" @endif data-toggle="modal" data-target="#delete{{$order->id}}" title="Trash" class="pd-setting-ed"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
				</div>
		
		 <!--Delete-->
		 <div id="delete{{$order->id}}" class="modal modal-edu-general fullwidth-popup-InformationproModal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header header-color-modal bg-color-2">
                        <h4 class="modal-title" style="text-align:right">حذف  امر البيع</h4>
                        <div class="modal-close-area modal-close-df">
                            <a class="close" data-dismiss="modal" href="#"><i class="fa fa-close"></i></a>
                        </div>
                    </div>
                    <div class="modal-body">
                        <span class="educate-icon educate-danger modal-check-pro information-icon-pro"> </span>
                        <h2></h2>
                        <h4>هل تريد حذف جميع بيانات أمر البيع ؟ </h4>
                        <h4>سيتم حذف أمر البيع بجميع أصنافه التي تم تدوينها</h4>
                    </div>
                    <div class="modal-footer info-md">
                        <a data-dismiss="modal" href="#">إلغــاء</a>
						<form id="delete" style="display: inline;" action="{{route('sales-order.destroy',$order->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">حذف</button>
                                </form>
                    </div>
                </div>
            </div>
        </div>
		<!--/Delete-->
		</td>
		</tr>
		@endforeach
	</tbody>
</table>