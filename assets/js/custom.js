var
  filters = {
    dentist: null,
    patient: null,
    procedure: null
  };

function updateFilters() {
  $('.task-list-row').hide().filter(function() {
    var
      self = $(this),
      result = true; // not guilty until proven guilty
    
    Object.keys(filters).forEach(function (filter) {
      if (filters[filter] && (filters[filter] != 'None') && (filters[filter] != 'Any')) {
        result = result && filters[filter] === self.data(filter);
      }
    });

    return result;
  }).show();
}

function changeFilter(filterName) {
  filters[filterName] = this.value;
  updateFilters();
}

// Assigned User Dropdown Filter
$('#dentist-filter').on('change', function() {
  changeFilter.call(this, 'dentist');
});

// Task Status Dropdown Filter
$('#patient-filter').on('change', function() {
  changeFilter.call(this, 'patient');
});

// Task Milestone Dropdown Filter
$('#procedure-filter').on('change', function() {
  changeFilter.call(this, 'procedure');
});

// // Task Priority Dropdown Filter
// $('#priority-filter').on('change', function() {
//   changeFilter.call(this, 'priority');
// });

// // Task Tags Dropdown Filter
// $('#tags-filter').on('change', function() {
//   changeFilter.call(this, 'tags');
// });

/*
future use for a text input filter
$('#search').on('click', function() {
    $('.box').hide().filter(function() {
        return $(this).data('order-number') == $('#search-criteria').val().trim();
    }).show();
});*/

function showPassword() {
    var x = document.getElementById("password");
    var y = document.getElementById("eye");
    
    if (x.type === "password") {
        y.className = "fas fa-eye-slash";
        x.type = "text";
    } else {
        y.className = "fas fa-eye";
        x.type = "password";
    }
}