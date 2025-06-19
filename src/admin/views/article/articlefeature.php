<div class="row">
	<div class="card col-4 mb-3" ng-repeat="item in data" ng-class="{'card-closed': !groupVisibility}" ng-init="groupVisibility=1">
		<div class="card-header text-uppercase" ng-click="groupVisibility=!groupVisibility">
			<span class="material-icons card-toggle-indicator">keyboard_arrow_down</span>
			{{ item.set.name }} - {{item.attributes.length}}

		</div>
		<div class="card-body" ng-show="groupVisibility">
			<div ng-repeat="(k, val) in item.attributes">
				<div class="form-group form-side-by-side" ng-class="{'input--hide-label': i18n}">
					<!--<div class="form-side form-side-label">
						<label for="{{k}}_{{item.set.id}}" class="ng-binding">Click to Select</label>
					</div> -->
					<div class="form-side">
						<div class="form-check">
							<input id="{{k}}_{{item.set.id}}" name="model[item.set.id][k]" ng-true-value="1" ng-click="toggleValSel(item.set.id,k)" ng-false-value="0" ng-model="model[item.set.id][k]" type="checkbox" checked="item.preSel.indexOf(k) !== -1" class="form-check-input-standalone ng-pristine ng-untouched ng-valid ng-empty" ng-checked="item.preSel.indexOf(k) !== -1" /><label for="{{k}}_{{item.set.id}}">{{val}}-{{k}}</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>