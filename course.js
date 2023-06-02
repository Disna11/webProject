fetch('course.json')
    .then((response) => response.json())
    .then(data => {
    
    const tableBody = document.getElementById('courseTableBody');
    [...data['Undergraduate Courses'], ...data['Postgraduate Courses']].forEach(course => {
    

    console.log(course.CourseName);
    const row = document.createElement('tr');
   


    const CourseName = document.createElement('td');
    const CourseIcon = document.createElement('img');
    CourseIcon.src = course.CourseIcon;
    CourseIcon.style.width = '20px'; // Adjust the width as desired
    CourseIcon.style.height = '35px'; // Adjust the height as desired
    const title = document.createElement('span');
    title.textContent = course.CourseName;
    CourseName.appendChild(CourseIcon);
    CourseName.appendChild(title);
    row.appendChild(CourseName);

    //course overview fetch from undergraduate & postgraduate courses

    const overview = document.createElement('td');
    overview.textContent = course.overview
    row.appendChild(overview);

    //course intake fetch from undergraduate & postgraduate courses

    const CourseIntake = document.createElement('td');
    CourseIntake.textContent = course.CourseIntake
    row.appendChild(CourseIntake);

    //Location is fetch from undergraduate & postgraduate courses

    const Location = document.createElement('td');
    Location.textContent = course.Location
    row.appendChild(Location);
     //course duration is fetch from undergraduate & postgraduate courses

     const CourseDuration = document.createElement('td');
     CourseDuration.textContent = course.CourseDuration
     row.appendChild(CourseDuration);

     //course details is fetch from undergraduate & postgraduate courses

     const CourseDetails = document.createElement('td');
     CourseDetails.textContent = course.CourseDetails
     row.appendChild(CourseDetails);

     //fetch entry requirements from undergraduate and postgraduate courses
     const EntryRequirements = document.createElement('td');
     const Students = course.EntryRequirements.Students.join(',');
     var li ='';
     course.EntryRequirements.Students.forEach(requirements => {
       li = li + '<li>' + requirements + '</li>'
     })
     EntryRequirements.innerHTML = '<ul>' + li + '</ul>';
     row.appendChild(EntryRequirements);
 
     //course duration is fetch from undergraduate & postgraduate courses
     const EnglishLanguageRequirements = document.createElement('td');
     EnglishLanguageRequirements.textContent = course.EnglishLanguageRequirements
     row.appendChild(EnglishLanguageRequirements); 

     const FeesStructure = document.createElement('td');
    const UKFullTime = course.FeesStructure.UKFullTime.join(',');
    const IntFullTime = course.FeesStructure.IntFullTime.join(',');
    var li = '';
    li += '<b>UK Full Time:</b>';
    course.FeesStructure.UKFullTime.forEach(requirement => {
     li += '<li>' + requirement + '</li>';
    });

    li += '<b>International Full Time:</b>';
    course.FeesStructure.IntFullTime.forEach(requirement => {
     li += '<li>' + requirement + '</li>';
      });
      FeesStructure.innerHTML = '<ul>' + li + '</ul>';
    row.appendChild(FeesStructure);

 



    tableBody.appendChild(row);
    })
 })