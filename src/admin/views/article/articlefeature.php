<pre>{{ model | json }}</pre>
<div class="row">
	<div class="card col-4 mb-3" ng-repeat="item in data" ng-class="{'card-closed': !groupVisibility}" ng-init="groupVisibility=1; model[item.set.id] = model[item.set.id] || {}">
		<div class="card-header text-uppercase" ng-click="groupVisibility = !groupVisibility">
			<span class="material-icons card-toggle-indicator">keyboard_arrow_down</span>
			{{ item.set.name }} - {{ item.attributes.length }}
		</div>

		<div class="card-body" ng-show="groupVisibility">
			<div ng-repeat="(k, val) in item.attributes">
				<div class="form-group form-side-by-side" ng-class="{'input--hide-label': i18n}">
					<div class="form-side">
						<div class="form-check">
							<input
								id="{{k}}_{{item.set.id}}"
								type="checkbox"
								ng-true-value="1"
								ng-false-value="0"
								ng-click="toggleValSel(item.set.id, k)"
								ng-init="initFeatureModel(item.set.id)"
								ng-model="model[item.set.id.toString()][k]"
								class="form-check-input-standalone" />
							<label for="{{k}}_{{item.set.id}}">{{ val }} - {{ k }}</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>