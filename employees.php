<?php require_once 'includes/header.php'; ?>

<div class="mb-4 animate__animated animate__fadeInDown">
    <h1 class="text-3xl font-extrabold text-gray-800">จัดการพนักงาน <i class="fa-solid fa-users text-primary"></i></h1>
    <p class="text-gray-500 mt-1">เพิ่ม แก้ไข ลบ และดูรายชื่อพนักงานทั้งหมด</p>
</div>

<!-- Control Panel -->
<div class="bg-white rounded-xl shadow-[0_4px_10px_rgba(0,0,0,0.05)] border border-gray-200 p-4 mb-4 relative z-20">
    <div class="flex flex-col md:flex-row items-end justify-between gap-3">
        <!-- ช่องค้นหา -->
        <div class="w-full md:w-1/3">
            <label class="block text-xs font-bold text-gray-700 mb-1">ค้นหารหัส / ชื่อ-นามสกุล</label>
            <input type="text" id="customSearch" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary text-sm p-2 border outline-none" placeholder="ค้นหา...">
        </div>
        
        <div class="flex gap-2">
            <!-- ปุ่มเพิ่มพนักงาน -->
            <button onclick="openAddModal()" class="shrink-0 bg-primary hover:bg-secondary text-white font-bold px-3 py-2 rounded-md shadow-sm transition-all focus:outline-none flex items-center justify-center gap-1 h-[38px]">
                <i class="fa-solid fa-user-plus"></i> <span class="text-sm">เพิ่มพนักงาน</span>
            </button>
        </div>
    </div>
</div>

<!-- ตารางแสดงพนักงาน -->
<div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 relative z-10 animate__animated animate__fadeInUp overflow-hidden">
    <table id="employeeTable" class="w-full text-left whitespace-nowrap" style="width:100%">
        <thead class="bg-gray-50 text-gray-700">
            <tr>
                <th class="py-2 px-3">รหัสพนักงาน</th>
                <th class="py-2 px-3">ชื่อ-นามสกุล</th>
                <th class="py-2 px-3">แผนก/ฝ่าย</th>
                <th class="py-2 px-3">ตำแหน่ง</th>
                <th class="py-2 px-3 text-center">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data will be loaded via AJAX/JS -->
        </tbody>
    </table>
</div>

<!-- Modal เพิ่มพนักงาน -->
<div id="addModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeAddModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <form id="addEmpForm">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4 border-b pb-2"><i class="fa-solid fa-user-plus text-primary"></i> เพิ่มข้อมูลพนักงาน</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">รหัสพนักงาน <span class="text-red-500">*</span></label>
                            <input type="text" name="emp_code" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
                            <input type="text" name="emp_name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">แผนก/ฝ่าย</label>
                            <input type="text" name="department" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ตำแหน่ง</label>
                            <input type="text" name="position" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-primary text-base font-medium text-white hover:bg-secondary focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">บันทึกข้อมูล</button>
                    <button type="button" onclick="closeAddModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal แก้ไขพนักงาน -->
<div id="editModal" class="hidden fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true" onclick="closeEditModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
            <form id="editEmpForm">
                <input type="hidden" name="id" id="edit_id">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4 border-b pb-2"><i class="fa-solid fa-pen-to-square text-blue-500"></i> แก้ไขข้อมูลพนักงาน</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">รหัสพนักงาน <span class="text-red-500">*</span></label>
                            <input type="text" name="emp_code" id="edit_emp_code" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ชื่อ-นามสกุล <span class="text-red-500">*</span></label>
                            <input type="text" name="emp_name" id="edit_emp_name" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">แผนก/ฝ่าย</label>
                            <input type="text" name="department" id="edit_department" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ตำแหน่ง</label>
                            <input type="text" name="position" id="edit_position" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse border-t border-gray-200">
                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">บันทึกการแก้ไข</button>
                    <button type="button" onclick="closeEditModal()" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">ยกเลิก</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
let dataTable;

document.addEventListener('DOMContentLoaded', () => {
    loadEmployees();

    // เพิ่มพนักงาน
    document.getElementById('addEmpForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let fd = new FormData(this);
        fd.append('action', 'add');

        fetch('api/employee_api.php', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(res => {
            if(res.status === 'success') {
                Swal.fire({ title: 'สำเร็จ!', text: res.message, icon: 'success', timer: 1500, showConfirmButton: false });
                closeAddModal();
                loadEmployees();
            } else {
                Swal.fire('ข้อผิดพลาด', res.message, 'error');
            }
        });
    });

    // แก้ไขพนักงาน
    document.getElementById('editEmpForm').addEventListener('submit', function(e) {
        e.preventDefault();
        let fd = new FormData(this);
        fd.append('action', 'update');

        fetch('api/employee_api.php', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(res => {
            if(res.status === 'success') {
                Swal.fire({ title: 'บันทึกสำเร็จ!', text: res.message, icon: 'success', timer: 1500, showConfirmButton: false });
                closeEditModal();
                loadEmployees();
            } else {
                Swal.fire('ข้อผิดพลาด', res.message, 'error');
            }
        });
    });
});

function loadEmployees() {
    fetch('api/employee_api.php?action=get_all')
        .then(res => res.json())
        .then(res => {
            if(res.status === 'success') {
                if(dataTable) dataTable.destroy();

                let tbody = document.querySelector('#employeeTable tbody');
                tbody.innerHTML = '';
                
                res.data.forEach(item => {
                    let tr = document.createElement('tr');
                    tr.className = 'hover-table-row';
                    tr.innerHTML = `
                        <td class="py-2 px-3 font-mono text-blue-600 font-medium">${item.emp_code}</td>
                        <td class="py-2 px-3 font-medium">${item.emp_name}</td>
                        <td class="py-2 px-3 text-gray-600">${item.department || '-'}</td>
                        <td class="py-2 px-3 text-gray-600">${item.position || '-'}</td>
                        <td class="py-2 px-3 text-center flex items-center justify-center gap-2">
                            <button onclick="openEditModal(${item.id})" class="text-blue-500 hover:text-blue-700 p-1.5 rounded transition-colors text-lg" title="แก้ไขข้อมูล">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </button>
                            <button onclick="deleteEmployee(${item.id})" class="text-red-500 hover:text-red-700 p-1.5 rounded transition-colors text-lg" title="ลบข้อมูล">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </td>
                    `;
                    tbody.appendChild(tr);
                });

                dataTable = $('#employeeTable').DataTable({
                    responsive: true,
                    dom: 'rt<"flex flex-col md:flex-row justify-between items-center mt-4 text-sm"ip>'
                });

                $('#customSearch').off('keyup').on('keyup', function() {
                    dataTable.search(this.value).draw();
                });
            }
        });
}

function openAddModal() {
    document.getElementById('addEmpForm').reset();
    document.getElementById('addModal').classList.remove('hidden');
}

function closeAddModal() {
    document.getElementById('addModal').classList.add('hidden');
}

function openEditModal(id) {
    if (!id) return;
    
    fetch(`api/employee_api.php?action=get_single&id=${id}`)
    .then(res => res.json())
    .then(res => {
        if(res.status === 'success') {
            let emp = res.data;
            document.getElementById('edit_id').value = emp.id;
            document.getElementById('edit_emp_code').value = emp.emp_code;
            document.getElementById('edit_emp_name').value = emp.emp_name;
            document.getElementById('edit_department').value = emp.department || '';
            document.getElementById('edit_position').value = emp.position || '';
            
            document.getElementById('editModal').classList.remove('hidden');
        } else {
            Swal.fire('ข้อผิดพลาด', res.message, 'error');
        }
    });
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

function deleteEmployee(id) {
    if (!id) return;

    Swal.fire({
        title: 'ยืนยันการลบ?',
        text: "คุณต้องการลบข้อมูลพนักงานคนนี้ใช่หรือไม่? ข้อมูลนี้ไม่สามารถกู้คืนได้!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'ใช่, ฉันต้องการลบ',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            let fd = new FormData();
            fd.append('action', 'delete');
            fd.append('id', id);

            fetch('api/employee_api.php', { method: 'POST', body: fd })
            .then(res => res.json())
            .then(res => {
                if(res.status === 'success') {
                    Swal.fire('ลบแล้ว!', res.message, 'success');
                    loadEmployees();
                } else {
                    Swal.fire('ข้อผิดพลาด', res.message, 'error');
                }
            });
        }
    });
}
</script>

<?php require_once 'includes/footer.php'; ?>
