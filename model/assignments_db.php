<?php

    // create function
    function add_assignment($course_id){
        global $db;
        $query = 'INSERT INTO assignments (Description, courseID) VALUES (:descr, :courseID)';
        $statement = $db->prepare($query);
        $statement->bindValue(':descr', $description);
        $statement->bindValue(':courseID', $course_id);
        $statement->execute();
        $statement->closeCursor();
    }

    // read function
    function get_assignments_by_course($course_id){
        global $db;
        if($course_id){
            $query = 'SELECT A.ID, A.DESCRIPTION, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID WHERE A.courseID = :course_id ORDER BY A.ID';
        }else{
            $query = 'SELECT A.ID, A.DESCRIPTION, C.courseName FROM assignments A LEFT JOIN courses C ON A.courseID = C.courseID ORDER BY C.courseID';
        }
        $statement = $db->prepare($query);
        // maybe put the following line into the if-block? not needed in else, and throws an error if applied when not needed
        // $statement->bindValue(':course_id', $course_id); 
        $statement->execute();
        $assignments = $statement->fetchAll();
        $statement->closeCursor();
        return $assignments;
    }

    // delete function
    function delete_assignment($assignment_id){
        global $db;
        $query = 'DELETE FROM assignments WHERE ID = :assign_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':assign_id', $assignment_id);
        $statement->execute();
        $statement->closeCursor();
    }



