<div ng-repeat="(k, val) in item.attributes track by k">
	<input type="checkbox" class="form-check-input" ng-checked="val.indexOf('-ok') !== -1" checked="val.indexOf('-ok') !== -1" id="b6gnil_{{k}}" ng-click="toggleSelection(val)" fieldid="{{k}}_{{item.set.id}}" fieldname="{{k}}_{{item.set.id}}" ng-model="model[item.set.id][k]">
	<label for="b6gnil_{{k}}" class="ng-binding">{{val}}-{{k}}_{{item.set.id}}</label>
	</input>
</div>

<div class="form-group" ng-repeat="(k, val) in item.attributes">
	<input type="checkbox" name="model[item.set.id][k]" id="{{k}}_{{item.set.id}}" value="{{k}}_{{item.set.id}}" ng-click="toggleSelection(val)" ng-model="model[item.set.id][k]"> <label for="{{k}}_{{item.set.id}}">
		{{val}}-{{k}}_{{item.set.id}}
	</label>
</div>