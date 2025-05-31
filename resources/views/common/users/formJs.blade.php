$scope.loading = {};
$scope.typeOptions = USER_TYPES;

$(document).on("click", ".show-password", function() {
    var input = $(this).closest(".form-group").find("input");
    if ($(input).attr("type") == "password") $(input).attr("type", "text");
    else $(input).attr("type", "password")
})

{{-- $scope.$watch('form.upgrade_type', function(newVal, oldVal) {
    if (newVal == 1 && !$scope.form.upgrade_to_date instanceof Date) {
        $scope.form.upgrade_to_date = moment($scope.form.upgrade_to_date).toDate();
    }
}); --}}