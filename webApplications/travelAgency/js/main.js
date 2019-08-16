$(document).ready(() => {
  $('#searchForm').on('submit', (e) => {	// Form element ID
    let searchText = $('#input').val();	// Input element ID
    getTravelLocation(searchText);
    e.preventDefault();
  });
});

