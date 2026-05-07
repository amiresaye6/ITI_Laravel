<?php

namespace App\Services;

class TaskManager
{
    public function __construct()
    {
        if (!session()->has("tasks")) {
            session()->put(
                "tasks",
                [
                    [
                        "id" => 1,
                        "project_id" => 101,
                        "board_column" => "In Progress",
                        "order" => 1,
                        "title" => "Implement Reviewer Workflow",
                        "description" => "Develop the logic for moving research papers through the IRB review stages.",
                        "completed" => false,
                        "due_date" => "2026-05-10",
                        "priority" => "high",
                        "tags" => ["backend", "php", "logic"],
                        "status" => "open",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Amir Alsayed",
                        "labels" => ["feature"],
                        "attachments" => ["workflow_v2.pdf"],
                        "comments" => ["Refactor the database seeding logic first."],
                        "color" => "#E91E63",
                        "subtasks" => [
                            ["id" => 201, "title" => "Define state transitions", "completed" => true],
                            ["id" => 202, "title" => "Write PHP controller methods", "completed" => false]
                        ],
                        "created_at" => "2026-04-25T10:00:00Z",
                        "updated_at" => "2026-05-05T14:20:00Z"
                    ],
                    [
                        "id" => 2,
                        "project_id" => 101,
                        "board_column" => "To Do",
                        "order" => 2,
                        "title" => "Database Seeding for Reviewers",
                        "description" => "Create seeders for the initial set of research reviewers in MySQL.",
                        "completed" => false,
                        "due_date" => "2026-05-08",
                        "priority" => "medium",
                        "tags" => ["database", "mysql"],
                        "status" => "open",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Mohammed Ibrahim",
                        "labels" => ["setup"],
                        "attachments" => [],
                        "comments" => [],
                        "color" => "#3F51B5",
                        "subtasks" => [],
                        "created_at" => "2026-04-28T09:00:00Z",
                        "updated_at" => "2026-04-28T09:00:00Z"
                    ],
                    [
                        "id" => 3,
                        "project_id" => 102,
                        "board_column" => "Done",
                        "order" => 1,
                        "title" => "Fix ShopIQ Banner Layout",
                        "description" => "Adjust the responsive CSS for the e-commerce showcase banner.",
                        "completed" => true,
                        "due_date" => "2026-05-01",
                        "priority" => "low",
                        "tags" => ["frontend", "css"],
                        "status" => "closed",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Hager Saeed",
                        "labels" => ["bugfix"],
                        "attachments" => ["screenshot_fix.png"],
                        "comments" => ["Verified on Chrome and Firefox."],
                        "color" => "#4CAF50",
                        "subtasks" => [
                            ["id" => 301, "title" => "Check mobile padding", "completed" => true]
                        ],
                        "created_at" => "2026-04-20T11:30:00Z",
                        "updated_at" => "2026-05-01T16:45:00Z"
                    ],
                    [
                        "id" => 4,
                        "project_id" => 103,
                        "board_column" => "To Do",
                        "order" => 1,
                        "title" => "Draft ITI Lab Instructions",
                        "description" => "Prepare the Markdown file for the upcoming Node.js session tasks.",
                        "completed" => false,
                        "due_date" => "2026-05-06",
                        "priority" => "high",
                        "tags" => ["education", "nodejs"],
                        "status" => "open",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Amir Alsayed",
                        "labels" => ["teaching"],
                        "attachments" => [],
                        "comments" => ["Include the Discord link for the session."],
                        "color" => "#FF9800",
                        "subtasks" => [],
                        "created_at" => "2026-05-03T08:00:00Z",
                        "updated_at" => "2026-05-05T10:00:00Z"
                    ],
                    [
                        "id" => 5,
                        "project_id" => 104,
                        "board_column" => "In Progress",
                        "order" => 1,
                        "title" => "Debug Docker Container Networking",
                        "description" => "Resolve issue where the frontend container cannot reach the backend API.",
                        "completed" => false,
                        "due_date" => "2026-05-07",
                        "priority" => "high",
                        "tags" => ["devops", "docker"],
                        "status" => "open",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Donia Mohamed",
                        "labels" => ["critical"],
                        "attachments" => ["docker-compose.yml"],
                        "comments" => ["Seems to be a bridge network configuration error."],
                        "color" => "#F44336",
                        "subtasks" => [
                            ["id" => 501, "title" => "Test ping between containers", "completed" => true],
                            ["id" => 502, "title" => "Update docker-compose networks", "completed" => false]
                        ],
                        "created_at" => "2026-05-04T13:00:00Z",
                        "updated_at" => "2026-05-05T15:00:00Z"
                    ],
                    [
                        "id" => 6,
                        "project_id" => 105,
                        "board_column" => "To Do",
                        "order" => 1,
                        "title" => "Design Metrics Search UI",
                        "description" => "Create a simple landing page section for customers to search metrics using Tailwind CSS.",
                        "completed" => false,
                        "due_date" => "2026-05-15",
                        "priority" => "medium",
                        "tags" => ["design", "tailwind"],
                        "status" => "open",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Amir Alsayed",
                        "labels" => ["ui/ux"],
                        "attachments" => [],
                        "comments" => ["Keep it simple, no complex animations."],
                        "color" => "#2196F3",
                        "subtasks" => [],
                        "created_at" => "2026-05-05T09:00:00Z",
                        "updated_at" => "2026-05-05T09:00:00Z"
                    ],
                    [
                        "id" => 7,
                        "project_id" => 101,
                        "board_column" => "Review",
                        "order" => 1,
                        "title" => "Audit IRB Security Headers",
                        "description" => "Ensure all PHP responses include necessary security headers (XSS, CSP).",
                        "completed" => false,
                        "due_date" => "2026-05-12",
                        "priority" => "medium",
                        "tags" => ["security", "php"],
                        "status" => "in-review",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Amir Badran",
                        "labels" => ["maintenance"],
                        "attachments" => [],
                        "comments" => [],
                        "color" => "#9C27B0",
                        "subtasks" => [
                            ["id" => 701, "title" => "Check Helmet.js equivalent for PHP", "completed" => true]
                        ],
                        "created_at" => "2026-04-30T14:00:00Z",
                        "updated_at" => "2026-05-04T11:20:00Z"
                    ],
                    [
                        "id" => 8,
                        "project_id" => 106,
                        "board_column" => "To Do",
                        "order" => 3,
                        "title" => "Prepare Freelance Proposal",
                        "description" => "Write a proposal for the new Laravel dashboard project on Upwork.",
                        "completed" => false,
                        "due_date" => "2026-05-06",
                        "priority" => "high",
                        "tags" => ["business", "freelance"],
                        "status" => "open",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Amir Alsayed",
                        "labels" => ["external"],
                        "attachments" => [],
                        "comments" => [],
                        "color" => "#009688",
                        "subtasks" => [],
                        "created_at" => "2026-05-05T12:00:00Z",
                        "updated_at" => "2026-05-05T12:00:00Z"
                    ],
                    [
                        "id" => 9,
                        "project_id" => 107,
                        "board_column" => "Done",
                        "order" => 1,
                        "title" => "Setup MQTT Broker",
                        "description" => "Configure the Mosquitto broker for the IoT lab demo.",
                        "completed" => true,
                        "due_date" => "2026-04-28",
                        "priority" => "low",
                        "tags" => ["iot", "network"],
                        "status" => "closed",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Ayman Khaled",
                        "labels" => ["lab-work"],
                        "attachments" => ["config_log.txt"],
                        "comments" => ["Works well with the ESP32 clients."],
                        "color" => "#795548",
                        "subtasks" => [],
                        "created_at" => "2026-04-25T15:00:00Z",
                        "updated_at" => "2026-04-28T10:30:00Z"
                    ],
                    [
                        "id" => 10,
                        "project_id" => 101,
                        "board_column" => "In Progress",
                        "order" => 3,
                        "title" => "Optimize MySQL Queries",
                        "description" => "Refactor the reviewer dashboard queries to improve load times.",
                        "completed" => false,
                        "due_date" => "2026-05-14",
                        "priority" => "medium",
                        "tags" => ["optimization", "mysql"],
                        "status" => "open",
                        "creator" => "Amir Alsayed",
                        "assigned_to" => "Ayman Shalaby",
                        "labels" => ["performance"],
                        "attachments" => [],
                        "comments" => ["Check indexing on the 'status' column."],
                        "color" => "#607D8B",
                        "subtasks" => [
                            ["id" => 1001, "title" => "Run EXPLAIN on current queries", "completed" => true],
                            ["id" => 1002, "title" => "Implement query caching", "completed" => false]
                        ],
                        "created_at" => "2026-05-02T11:00:00Z",
                        "updated_at" => "2026-05-05T16:00:00Z"
                    ]
                ]
            );
        }
    }

    public function getAll()
    {
        return session()->get("tasks");
    }

    public function find($id)
    {
        $tasks = session()->get("tasks");
        foreach ($tasks as $task) {
            if ($task["id"] == $id) {
                return $task;
            }
        }
        return null;
    }


    // public function updateTask($id, $data)
    // {
    //     $tasks = session()->get("tasks");
    //     $taskToUpdate = null;
    //     foreach ($tasks as $task) {
    //         if ($task["id"] == $id) {
    //             $taskToUpdate = $task;
    //         }
    //     }
    //     if(isset($taskToUpdate)) {

    //     }
    // }


    public function addTask($data)
    {
        $tasks = session()->get("tasks");

        $newId = time();
        // $newId = count($tasks) > 9 ? max(array_column($tasks, "id")) + 1 : 1;
        $data["id" ] = $newId;

        $tasks[] = $data;

        session()->put("tasks", $tasks);
    }
    
    public function deleteTask($id)
    {
        $tasks = session()->get("tasks");

        $newTasks = [];

        foreach ($tasks as $task) {
            if ($task["id"] != $id) {
                $newTasks[] = $task;
            }
        }

        session()->put("tasks", $newTasks);
    }



}
