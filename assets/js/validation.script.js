$(document).ready(function(){
	$('#adminlogin').validate({
		rules:{
            email:{
                required:true,
                email:true
            },
            password:{
                required:true
            }
        },
        messages:{
            email:{
                required:"Please enter your email address",
                email:"Please a valid email address"
            },
            password:{
                required:"Please enter your password"
            }
        }
	});
    $('#employee').validate({
        rules:{
            emp_id:{
                required:true
            },
            emp_name:{
                required:true,
                maxlength:100,
                number:false
            },
            username:{
                required:true,
                maxlength:100
            },
            emp_profile:{
                required:true
            },
            emp_email:{
                required:true,
                email:true
            },
            emp_phone:{
                required:true,
                number:true,
                maxlength:10
            },
            joining_date:{
                required:true
            },
            password:{
                required:true,
                maxlength:100
            }
        },
        messages:{
            emp_id:{
                required:"Please enter employee id"
            },
            emp_name:{
                
                required:"Please enter employee name",
                maxlength:"Maximum length 100 alphanumeric characters only",
                number:false
            },
            username:{
                required:"Please enter employee username",
                maxlength:"Maximum length 100 alphanumeric characters only"
            },
            emp_profile:{
                required:"Please choose employee profile"
            },
            emp_email:{
                required:"Please enter employee email address",
                email:"Please enter a valid email address"
            },
            emp_phone:{
                required:"Please enter employee phone number",
                number:"Only numeric values",
                maxlength:"Maximum length 10 alphanumeric characters only"
            },
            joining_date:{
                required:"Please enter employee joining date"
            },
            password:{
                required:"Please enter employee password",
                maxlength:"Maximum length 100 alphanumeric characters only"
            }
        }
    });
    $('#editemployee').validate({
        rules:{
            emp_id:{
                required:true
            },
            emp_name:{
                required:true,
                maxlength:100,
                number:false
            },
            username:{
                required:true,
                maxlength:100
            },
            emp_email:{
                required:true,
                email:true
            },
            emp_phone:{
                required:true,
                number:true,
                maxlength:10
            },
            joining_date:{
                required:true
            },
            password:{
                required:true,
                maxlength:100
            }
        },
        messages:{
            emp_id:{
                required:"Please enter employee id"
            },
            emp_name:{
                
                required:"Please enter employee name",
                maxlength:"Maximum length 100 alphanumeric characters only",
                number:false
            },
            username:{
                required:"Please enter employee username",
                maxlength:"Maximum length 100 alphanumeric characters only"
            },
            emp_email:{
                required:"Please enter employee email address",
                email:"Please enter a valid email address"
            },
            emp_phone:{
                required:"Please enter employee phone number",
                number:"Only numeric values",
                maxlength:"Maximum length 10 alphanumeric characters only"
            },
            joining_date:{
                required:"Please enter employee joining date"
            },
            password:{
                required:"Please enter employee password",
                maxlength:"Maximum length 100 alphanumeric characters only"
            }
        }
    });
    $('#projects').validate({
        rules:{
            project_name:{
                required:true,
                maxlength:100,
                number:false
            },
            project_start_date:{
                required:true
            },
            project_end_date:{
                required:true
            },
            project_category:{
                required:true
            },
            project_dashboard:{
                required:true
            },
            project_framework:{
                required:true
            },
            project_assigned_person:{
                required:true
            }
        },
        messages:{
            project_name:{
                
                required:"Please enter employee name",
                maxlength:"Maximum length 100 alphanumeric characters only",
                number:false
            },
            project_start_date:{
                required:"Please enter project start date"
            },
            project_end_date:{
                required:"Please enter project end date"
            },
            project_category:{
                required:"Please choose project category"
            },
            project_dashboard:{
                required:"Please choose project dashboard"
            },
            project_framework:{
                required:"Please choose project framework"
            },
            project_assigned_person:{
                required:"Please choose person assigned to this project"
            }
        }
    });
    
    $('#eprojects').validate({
        rules:{
            project_name:{
                required:true,
                maxlength:100,
                number:false
            },
            project_start_date:{
                required:true
            },
            project_end_date:{
                required:true
            },
            project_category:{
                required:true
            },
            project_dashboard:{
                required:true
            },
            project_framework:{
                required:true
            },
            project_assigned_person:{
                required:true
            }
        },
        messages:{
            project_name:{
                
                required:"Please enter employee name",
                maxlength:"Maximum length 100 alphanumeric characters only",
                number:false
            },
            project_start_date:{
                required:"Please enter project start date"
            },
            project_end_date:{
                required:"Please enter project end date"
            },
            project_category:{
                required:"Please choose project category"
            },
            project_dashboard:{
                required:"Please choose project dashboard"
            },
            project_framework:{
                required:"Please choose project framework"
            },
            project_assigned_person:{
                required:"Please choose person assigned to this project"
            }
        }
    });
});
/*********** edit function *******/
function edit_employees(id){
    $.ajax({
        type:"POST",
        url: 'editemployees',
        data: {id:id},
        success: function(data)
        {
            var obj = jQuery.parseJSON(data);
            $.each(obj, function(key,value) {
                document.getElementById('employees_id').value = value.id;
                document.getElementById('emp_id').value = value.emp_id;
                document.getElementById('emp_name').value = value.emp_name;
                document.getElementById('username').value = value.username;
                document.getElementById('eimage').value = value.emp_profile;
                document.getElementById('emp_email').value = value.emp_email;
                document.getElementById('emp_phone').value = value.emp_phone;
                document.getElementById('joining_date').value = value.joining_date;
                document.getElementById('password').value = value.emp_password;
                document.getElementById('note').value = value.note;
                if(value.project_read == 1){
                    $('#project_read').attr( "checked","checked" );
                }
                if(value.project_create == 1){
                    $('#project_create').attr( "checked","checked" );
                }
                if(value.project_update == 1){
                    $('#project_update').attr( "checked","checked" );
                }
                if(value.project_delete == 1){
                    $('#project_delete').attr( "checked","checked" );
                }
                if(value.tasks_read == 1){
                    $('#tasks_read').attr( "checked","checked" );
                }
                if(value.tasks_create == 1){
                    $('#tasks_create').attr( "checked","checked" );
                }
                if(value.tasks_update == 1){
                    $('#tasks_update').attr( "checked","checked" );
                }
                if(value.tasks_delete == 1){
                    $('#tasks_delete').attr( "checked","checked" );
                }
                if(value.timesheet_read == 1){
                    $('#timesheet_read').attr( "checked","checked" );
                }
                if(value.timesheet_create == 1){
                    $('#timesheet_create').attr( "checked","checked" );
                }
                if(value.timesheet_update == 1){
                    $('#timesheet_update').attr( "checked","checked" );
                }
                if(value.timesheet_delete == 1){
                    $('#timesheet_delete').attr( "checked","checked" );
                }
            });  
            $('#editemp').modal('show');
        }
    });
}
function edit_projects(id){
    $.ajax({
        type:"POST",
        url: 'editprojects',
        data: {id:id},
        success: function(data)
        {
            var obj = jQuery.parseJSON(data);
            $.each(obj, function(key,value) {
                document.getElementById('projects_id').value = value.id;
                document.getElementById('eproject_name').value = value.project_name;
                document.getElementById('eproject_start_date').value = value.project_start_date;
                document.getElementById('eproject_end_date').value = value.project_end_date;
                $('#eproject_category').val(value.project_category);
                $('#eproject_dashboard').val(value.project_dashboard);
                $('#eproject_framework').val(value.project_framework);
                document.getElementById('edescription').value = value.description;
                $('#project_status').val(value.status);
            });  
            $('#editproject').modal('show');
        }
    });
}

$(document).ready(function(){
    $('#success').delay(10000).fadeOut();
});