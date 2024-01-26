
<zaa-checkbox-array options="service.adminFeatures.relationdata" fieldid="dataupdateadminfeatures" model="data.update.adminFeatures" label="Admin Features" fieldname="adminFeatures" i18n="" class="ng-isolate-scope">
    <div class="form-group form-side-by-side" ng-class="{'input--hide-label': i18n}">
        <div class="form-side form-side-label"><label for="dataupdateadminfeatures" class="ng-binding">Admin Features</label></div>
        <div class="form-side">
           
            <!-- ngRepeat: (k, item) in optionitems track by k -->
            <div class="form-check ng-scope" ng-repeat="(k, item) in optionitems track by k">
                <input type="checkbox" class="form-check-input" ng-checked="isChecked(item)" id="b6gnil_0" ng-click="toggleSelection(item)" checked="checked" /><label for="b6gnil_0" class="ng-binding">Colors</label>
            </div>
            <!-- end ngRepeat: (k, item) in optionitems track by k -->
            <div class="form-check ng-scope" ng-repeat="(k, item) in optionitems track by k">
                <input type="checkbox" class="form-check-input" ng-checked="isChecked(item)" id="b6gnil_1" ng-click="toggleSelection(item)" /><label for="b6gnil_1" class="ng-binding">Flavour</label>
            </div>
            <!-- end ngRepeat: (k, item) in optionitems track by k -->
        </div>
    </div>
</zaa-checkbox-array>
