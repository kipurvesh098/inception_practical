<div class="row">
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="form-group">                                     
				<label for="vTitle">Title <span class="text-danger">*</span></label>
				{!! Form::text('vTitle',null,['id'=>'vTitle' ,'class' => 'form-control', 'placeholder' => __('Title')]) !!}
				@if($errors->first('vTitle'))
				<span class="text-danger">{{ $errors->first('vTitle') }}</span>
				@endif
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="iParentCategoryId">Category</label>
				{!! Form::select('iParentCategoryId', ['' => 'Select Category']+$categoryList, null, ['class' => 'form-control','id' => 'iParentCategoryId']) !!}
				@if($errors->first('iParentCategoryId'))
				<span class="text-danger">{{ $errors->first('iParentCategoryId') }}</span>
				@endif
			</div>
		</div>
	</div>
	
	<div class="col-md-12">
		<div class="col-md-6">
			<div class="form-group">
				<label for="tiStatus">Status <span class="text-danger">*</span></label>
				<p>
					<label class="ml-5">
						<input type="radio" name="tiStatus" id="tiStatus" class="flat-red" value="{{STATUS_ACTIVE}}" {{ ($category && $category->tiStatus == STATUS_ACTIVE && empty(old('tiStatus')) || ( old() && old('tiStatus') == STATUS_ACTIVE ))?"checked":"" }}>
						<span class="ml-5">Active</span>
					</label>
					<label class="ml-20">
						<input type="radio" name="tiStatus" id="tiStatus" class="flat-red" value="{{STATUS_INACTIVE}}" {{ ($category && $category->tiStatus == STATUS_INACTIVE && empty(old('tiStatus')) || ( !empty(old()) && old('tiStatus') == STATUS_INACTIVE ))?"checked":"" }}>
						<span class="ml-5">Inactive</span>
					</label>
				</p>
				@if($errors->first('tiStatus'))
				<span class="text-danger">{{ $errors->first('tiStatus') }}</span>
				@endif
			</div>
		</div>
	</div>
</div>