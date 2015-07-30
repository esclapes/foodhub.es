
NewOrderController.$inject = ['$scope', '$log'];

function NewOrderController($scope, $log) {

    var vm = this;
    
    vm.title = "Testing...";
    vm.date = null;
    vm.initDate = null;
    vm.today = today;
    vm.opened = false;
    vm.clear = clear;
    vm.formats = ['dd-MMMM-yyyy', 'yyyy/MM/dd', 'dd.MM.yyyy', 'shortDate'];
    vm.format = vm.formats[1];
    vm.dateOptions = {
        formatYear: 'yy',
        startingDay: 1
    };
    vm.events = events;
    vm.getDayClass = getDayClass;
    vm.disable = disable;
    vm.open = open;

    activate();

    //////////////

    function activate(){
        today();
        toggleMin();
    }

    function today() {
        vm.date = vm.initDate = new Date();
    };

    // Disable weekend selection
    function disable(date, mode) {
        return ( mode === 'day' && ( date.getDay() === 0 || date.getDay() === 6 ) );
    };

    function toggleMin() {
        vm.minDate = vm.minDate ? null : new Date();
    };

    function clear() {
        vm.date = null;
    };

    function open($event) {
        $event.preventDefault();
        $event.stopPropagation();

        vm.opened = true;
    };

    var tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    var afterTomorrow = new Date();
    afterTomorrow.setDate(tomorrow.getDate() + 2);
    var events =
    [
        {
            date: tomorrow,
            status: 'full'
        },
        {
            date: afterTomorrow,
            status: 'partially'
        }
    ];

    function getDayClass(date, mode) {
        if (mode === 'day') {
          var dayToCheck = new Date(date).setHours(0,0,0,0);

          for (var i=0; i < vm.events.length; i++){
            var currentDay = new Date(vm.events[i].date).setHours(0,0,0,0);

            if (dayToCheck === currentDay) {
              return vm.events[i].status;
            }
          }
        }

        return '';
      };
};

module.exports = NewOrderController;