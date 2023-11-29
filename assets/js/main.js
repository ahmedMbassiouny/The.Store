function toggleSidebar() {
    const body = document.querySelector('body');
    body.classList.toggle('toggle-sidebar');
  }
  
  if (document.querySelector('.toggle-sidebar-btn')) {
    document.querySelector('.toggle-sidebar-btn').addEventListener('click', toggleSidebar);
}