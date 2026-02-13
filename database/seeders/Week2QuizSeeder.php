<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Week2QuizSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with Week 2 Quiz.
     */
    public function run(): void
    {
        // Create Quiz
        $quiz = Quiz::create([
            'title' => 'Week 2 - Server Fundamentals and Installation',
            'description' => 'Server types, hardware components, subsystems, installation methods, editions, lifecycle planning, and Windows Server deployment',
            'total_questions' => 40,
        ]);

        // Quiz data with all 40 multiple choice questions
        $quizData = [
            [
                'question' => 'A bottleneck occurs when:',
                'answers' => [
                    ['text' => 'The server runs antivirus', 'letter' => 'a', 'correct' => false],
                    ['text' => 'A subsystem failure limits overall performance', 'letter' => 'b', 'correct' => true],
                    ['text' => 'RAM increases', 'letter' => 'c', 'correct' => false],
                    ['text' => 'The network improves', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'NIC stands for:',
                'answers' => [
                    ['text' => 'Network Internal Controller', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Network Interface Card', 'letter' => 'b', 'correct' => true],
                    ['text' => 'New Internet Configuration', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Network Input Core', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Volatile memory refers to:',
                'answers' => [
                    ['text' => 'SSD storage', 'letter' => 'a', 'correct' => false],
                    ['text' => 'RAM that loses data when power is removed', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Hard drive', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Flash storage', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'A server primarily:',
                'answers' => [
                    ['text' => 'Plays multimedia', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Provides resources and services to clients', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Runs personal applications only', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Replaces routers', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Which is NOT a common server type?',
                'answers' => [
                    ['text' => 'Web server', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Database server', 'letter' => 'b', 'correct' => false],
                    ['text' => 'File server', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Gaming console server', 'letter' => 'd', 'correct' => true],
                ]
            ],
            [
                'question' => 'The processor acts as the:',
                'answers' => [
                    ['text' => 'Storage device', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Brain performing calculations', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Network cable', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Backup device', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Major processor manufacturers include:',
                'answers' => [
                    ['text' => 'Google and Meta', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Intel and AMD', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Microsoft and Apple', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Dell and HP', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'RAM is identified as:',
                'answers' => [
                    ['text' => 'Long-term storage', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Primary performance factor', 'letter' => 'b', 'correct' => true],
                    ['text' => 'External storage', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Backup device', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'HDD storage:',
                'answers' => [
                    ['text' => 'Has no moving parts', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Uses mechanical rotating platters', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Is faster than SSD', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Is volatile', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'SSD storage:',
                'answers' => [
                    ['text' => 'Uses rotating disks', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Has moving parts', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Is purely electronic with faster access', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Is slower than HDD', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Minimum acceptable server NIC speed:',
                'answers' => [
                    ['text' => '10 Mbps', 'letter' => 'a', 'correct' => false],
                    ['text' => '50 Mbps', 'letter' => 'b', 'correct' => false],
                    ['text' => '100 Mbps', 'letter' => 'c', 'correct' => true],
                    ['text' => '1 Gbps', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Industry standard server speed:',
                'answers' => [
                    ['text' => '100 Mbps', 'letter' => 'a', 'correct' => false],
                    ['text' => '1 Gbps', 'letter' => 'b', 'correct' => true],
                    ['text' => '10 Mbps', 'letter' => 'c', 'correct' => false],
                    ['text' => '10 Gbps only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Server lifecycle estimate:',
                'answers' => [
                    ['text' => '1–2 years', 'letter' => 'a', 'correct' => false],
                    ['text' => '3–5 years', 'letter' => 'b', 'correct' => true],
                    ['text' => '10 years', 'letter' => 'c', 'correct' => false],
                    ['text' => '20 years', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'File Services are used for:',
                'answers' => [
                    ['text' => 'Hosting websites', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Centralized file storage and sharing', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Email encryption', 'letter' => 'c', 'correct' => false],
                    ['text' => 'BIOS updates', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Print Services:',
                'answers' => [
                    ['text' => 'Store emails', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Manage multiple print jobs', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Control routers', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Manage RAM', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'IIS 7.5 is used for:',
                'answers' => [
                    ['text' => 'Storage management', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Web hosting services', 'letter' => 'b', 'correct' => true],
                    ['text' => 'File compression', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Network firewall', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'A bottleneck in one subsystem:',
                'answers' => [
                    ['text' => 'Affects only that component', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Affects entire system performance', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Improves speed', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Has no impact', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Windows Server 2008 R2 is:',
                'answers' => [
                    ['text' => '32-bit only', 'letter' => 'a', 'correct' => false],
                    ['text' => '64-bit only', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Hybrid 32/64', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Cloud-only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'In-place upgrade from 32-bit to 64-bit:',
                'answers' => [
                    ['text' => 'Is supported', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Is NOT supported', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Requires BIOS reset', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Is automatic', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Foundation edition is designed for:',
                'answers' => [
                    ['text' => 'Large enterprises', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Small businesses (<15 users)', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Data centers', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Government agencies', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Standard edition focuses on:',
                'answers' => [
                    ['text' => 'No virtualization', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Virtualization and power savings', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Gaming', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Limited RAM', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Enterprise edition includes:',
                'answers' => [
                    ['text' => 'Failover clustering', 'letter' => 'a', 'correct' => true],
                    ['text' => 'No scaling', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Home networking', 'letter' => 'c', 'correct' => false],
                    ['text' => '32-bit support', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Datacenter edition is ideal for:',
                'answers' => [
                    ['text' => 'Small home use', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Large-scale virtualization', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Gaming cafés', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Student projects', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Web Server edition is:',
                'answers' => [
                    ['text' => 'Built for internet-facing servers', 'letter' => 'a', 'correct' => true],
                    ['text' => 'Designed for home PCs', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Used for printing', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Used for file storage only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Clean installation:',
                'answers' => [
                    ['text' => 'Keeps old settings', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Provides fresh start', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Is faster but risky', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Requires no updates', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Upgrade installation:',
                'answers' => [
                    ['text' => 'Removes old settings', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Keeps previous configurations', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Is always possible', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Converts 32-bit to 64-bit', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Disk cloning involves:',
                'answers' => [
                    ['text' => 'Manual installation', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Sector-by-sector copying', 'letter' => 'b', 'correct' => true],
                    ['text' => 'BIOS flashing', 'letter' => 'c', 'correct' => false],
                    ['text' => 'RAM duplication', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Sysprep is used to:',
                'answers' => [
                    ['text' => 'Install antivirus', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Remove machine-specific identifiers', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Delete OS', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Format HDD', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Unattended installation uses:',
                'answers' => [
                    ['text' => 'BIOS file', 'letter' => 'a', 'correct' => false],
                    ['text' => 'autounattend.xml', 'letter' => 'b', 'correct' => true],
                    ['text' => 'boot.ini', 'letter' => 'c', 'correct' => false],
                    ['text' => 'config.sys', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Windows Deployment Services (WDS):',
                'answers' => [
                    ['text' => 'Installs Windows over the network', 'letter' => 'a', 'correct' => true],
                    ['text' => 'Replaces BIOS', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Manages RAM', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Controls printer', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Windows Updates:',
                'answers' => [
                    ['text' => 'Are optional and not important', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Provide service packs and critical patches', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Remove drivers', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Disable security', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Service Packs improve:',
                'answers' => [
                    ['text' => 'Graphics only', 'letter' => 'a', 'correct' => false],
                    ['text' => 'System stability and resilience', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Printer ink', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Screen resolution', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Future planning avoids:',
                'answers' => [
                    ['text' => 'System upgrades', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Early reinstallation', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Scalability', 'letter' => 'c', 'correct' => false],
                    ['text' => 'ROI', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'ROI stands for:',
                'answers' => [
                    ['text' => 'Return on Investment', 'letter' => 'a', 'correct' => true],
                    ['text' => 'Rate of Installation', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Resource Output Index', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Remote Online Integration', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Network subsystem health depends on:',
                'answers' => [
                    ['text' => 'CPU only', 'letter' => 'a', 'correct' => false],
                    ['text' => 'NIC performance', 'letter' => 'b', 'correct' => true],
                    ['text' => 'RAM only', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Storage only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Primary subsystems include:',
                'answers' => [
                    ['text' => 'CPU, RAM, Storage, Network', 'letter' => 'a', 'correct' => true],
                    ['text' => 'Monitor, Keyboard, Mouse', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Printer, Router, Scanner', 'letter' => 'c', 'correct' => false],
                    ['text' => 'GPU only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'A weak component causes:',
                'answers' => [
                    ['text' => 'Balanced performance', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Entire system degradation', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Faster processing', 'letter' => 'c', 'correct' => false],
                    ['text' => 'No effect', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Datacenter edition supports:',
                'answers' => [
                    ['text' => 'Low scalability', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Highly demanding business applications', 'letter' => 'b', 'correct' => true],
                    ['text' => '32-bit hardware', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Small offices only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Failover clustering ensures:',
                'answers' => [
                    ['text' => 'Data deletion', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Service continuity during hardware faults', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Faster internet', 'letter' => 'c', 'correct' => false],
                    ['text' => 'BIOS recovery', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Strategic lifecycle planning ensures:',
                'answers' => [
                    ['text' => 'Lower ROI', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Scalability and cost efficiency', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Random upgrades', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Reduced stability', 'letter' => 'd', 'correct' => false],
                ]
            ],
        ];

        // Create questions and answers
        foreach ($quizData as $questionNumber => $questionData) {
            $question = $quiz->questions()->create([
                'question_text' => $questionData['question'],
                'question_type' => 'multiple_choice',
                'question_number' => $questionNumber + 1,
            ]);

            // Create answer options
            foreach ($questionData['answers'] as $answerData) {
                $question->answers()->create([
                    'answer_text' => $answerData['text'],
                    'answer_letter' => $answerData['letter'],
                    'is_correct' => $answerData['correct'],
                ]);
            }
        }
    }
}
