<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Quiz
        $quiz = Quiz::create([
            'title' => 'Device Drivers & Hardware Management',
            'description' => 'Complete quiz on device drivers, hardware configuration, and Windows management tools',
            'total_questions' => 50,
        ]);

        // PART I - Multiple Choice (30 items)
        $multipleChoiceData = [
            [
                'question' => 'A device driver is a program that:',
                'answers' => [
                    ['text' => 'Installs hardware automatically', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Controls a device and acts as a translator between OS and hardware', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Monitors system performance', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Manages network security', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Plug and Play (PnP) allows devices to:',
                'answers' => [
                    ['text' => 'Be manually configured using jumpers', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Be automatically recognized and configured', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Work only with expansion cards', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Disable automatic drivers', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Plug and Play was released by Intel and Microsoft in:',
                'answers' => [
                    ['text' => '1990', 'letter' => 'a', 'correct' => false],
                    ['text' => '1995', 'letter' => 'b', 'correct' => true],
                    ['text' => '2000', 'letter' => 'c', 'correct' => false],
                    ['text' => '1983', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'IRQ stands for:',
                'answers' => [
                    ['text' => 'Internal Request Queue', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Interrupt Request', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Internal Resource Query', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Integrated Resource Quality', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'DMA allows memory access without involving the:',
                'answers' => [
                    ['text' => 'RAM', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Hard drive', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Processor', 'letter' => 'c', 'correct' => true],
                    ['text' => 'BIOS', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'I/O port addresses are used to:',
                'answers' => [
                    ['text' => 'Store files', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Transfer data between device and processor', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Allocate RAM', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Install drivers', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'A signed driver includes a:',
                'answers' => [
                    ['text' => 'License key', 'letter' => 'a', 'correct' => false],
                    ['text' => 'BIOS code', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Digital signature', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Serial number', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Devices and Printers folder includes:',
                'answers' => [
                    ['text' => 'Internal RAM', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Expansion cards', 'letter' => 'b', 'correct' => false],
                    ['text' => 'USB and network devices', 'letter' => 'c', 'correct' => true],
                    ['text' => 'BIOS settings', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Devices and Printers does NOT display:',
                'answers' => [
                    ['text' => 'USB devices', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Digital cameras', 'letter' => 'b', 'correct' => false],
                    ['text' => 'PS/2 keyboards', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Music players', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Device Manager allows you to:',
                'answers' => [
                    ['text' => 'Format hard drives', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Enable, disable, or uninstall devices', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Edit registry keys', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Install Windows', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Roll Back Driver is used when:',
                'answers' => [
                    ['text' => 'Installing a new OS', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Updating BIOS', 'letter' => 'b', 'correct' => false],
                    ['text' => 'A new driver causes problems', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Formatting disk', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'The Microsoft Management Console (MMC) is used to:',
                'answers' => [
                    ['text' => 'Play media files', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Manage Windows administrative tools', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Install hardware only', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Edit documents', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Administrative Tools is located in:',
                'answers' => [
                    ['text' => 'BIOS', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Task Manager', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Control Panel', 'letter' => 'c', 'correct' => true],
                    ['text' => 'File Explorer', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Event Viewer is used to:',
                'answers' => [
                    ['text' => 'Install drivers', 'letter' => 'a', 'correct' => false],
                    ['text' => 'View system event logs', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Configure firewall', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Manage printers', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Performance Monitor checks:',
                'answers' => [
                    ['text' => 'Printer ink levels', 'letter' => 'a', 'correct' => false],
                    ['text' => 'CPU, memory, disk, and network performance', 'letter' => 'b', 'correct' => true],
                    ['text' => 'User passwords', 'letter' => 'c', 'correct' => false],
                    ['text' => 'BIOS updates', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Print Management is used to:',
                'answers' => [
                    ['text' => 'Format drives', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Manage printers and print servers', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Install OS', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Update drivers', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Server Management console allows you to:',
                'answers' => [
                    ['text' => 'Play server games', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Manage server roles', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Format RAM', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Install antivirus', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Remote Server Administration Tools (RSAT) enables:',
                'answers' => [
                    ['text' => 'Local gaming', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Remote server management', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Device formatting', 'letter' => 'c', 'correct' => false],
                    ['text' => 'BIOS editing', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'A Server Role is:',
                'answers' => [
                    ['text' => 'A security password', 'letter' => 'a', 'correct' => false],
                    ['text' => 'A set of programs enabling a server function', 'letter' => 'b', 'correct' => true],
                    ['text' => 'A device driver', 'letter' => 'c', 'correct' => false],
                    ['text' => 'A registry key', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'A Service is:',
                'answers' => [
                    ['text' => 'Hardware component', 'letter' => 'a', 'correct' => false],
                    ['text' => 'A program that performs system functions', 'letter' => 'b', 'correct' => true],
                    ['text' => 'BIOS firmware', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Device port', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Automatic startup means the service:',
                'answers' => [
                    ['text' => 'Never starts', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Starts when system starts', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Starts manually only', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Starts after 5 minutes', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Manual startup means:',
                'answers' => [
                    ['text' => 'Starts automatically', 'letter' => 'a', 'correct' => false],
                    ['text' => 'User must start it', 'letter' => 'b', 'correct' => true],
                    ['text' => 'It is disabled', 'letter' => 'c', 'correct' => false],
                    ['text' => 'It starts before boot', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Disabled service means:',
                'answers' => [
                    ['text' => 'Starts automatically', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Cannot be started', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Delayed start', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Network only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'The Server service supports:',
                'answers' => [
                    ['text' => 'Video streaming', 'letter' => 'a', 'correct' => false],
                    ['text' => 'File and print sharing', 'letter' => 'b', 'correct' => true],
                    ['text' => 'BIOS updates', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Antivirus scanning', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'The Workstation service allows:',
                'answers' => [
                    ['text' => 'Access to shared folders on other computers', 'letter' => 'a', 'correct' => true],
                    ['text' => 'Registry editing', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Printer formatting', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Disk cloning', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'The Windows registry is a:',
                'answers' => [
                    ['text' => 'Word processor', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Central secure database', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Printer manager', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Gaming tool', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Registry keys act like:',
                'answers' => [
                    ['text' => 'Programs', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Folders', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Printers', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Drivers', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'HKEY_LOCAL_MACHINE stores settings specific to:',
                'answers' => [
                    ['text' => 'Current user', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Network printer', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Local computer', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Remote server', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'HKEY_CURRENT_USER stores settings for:',
                'answers' => [
                    ['text' => 'All computers', 'letter' => 'a', 'correct' => false],
                    ['text' => 'BIOS', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Logged-in user', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Server only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'HKEY_CURRENT_CONFIG contains information that is:',
                'answers' => [
                    ['text' => 'Permanently stored', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Regenerated at boot time', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Deleted after login', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Stored in cloud', 'letter' => 'd', 'correct' => false],
                ]
            ],
        ];

        // Seed multiple choice questions
        foreach ($multipleChoiceData as $index => $data) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $data['question'],
                'question_type' => 'multiple_choice',
                'question_number' => $index + 1,
            ]);

            foreach ($data['answers'] as $answerData) {
                Answer::create([
                    'question_id' => $question->id,
                    'answer_text' => $answerData['text'],
                    'answer_letter' => $answerData['letter'],
                    'is_correct' => $answerData['correct'],
                ]);
            }
        }

        // PART II - Identification (10 items)
        $identificationData = [
            ['question' => 'A feature that automatically detects and configures hardware.', 'answer' => 'Plug and Play (PnP)'],
            ['question' => 'A driver with a digital security mark.', 'answer' => 'Signed Driver'],
            ['question' => 'Tool used to manage hardware devices graphically.', 'answer' => 'Device Manager'],
            ['question' => 'A centralized administrative framework for Windows tools.', 'answer' => 'Microsoft Management Console (MMC)'],
            ['question' => 'Tool used to view system logs.', 'answer' => 'Event Viewer'],
            ['question' => 'Tool used to schedule tasks automatically.', 'answer' => 'Task Scheduler'],
            ['question' => 'A program that runs in the background to support other programs.', 'answer' => 'Service'],
            ['question' => 'The central database storing configuration settings.', 'answer' => 'Registry'],
            ['question' => 'Registry hive for file associations.', 'answer' => 'HKEY_CLASSES_ROOT'],
            ['question' => 'Startup type that prevents a service from starting.', 'answer' => 'Disabled'],
        ];

        // Seed identification questions
        foreach ($identificationData as $index => $data) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $data['question'],
                'question_type' => 'identification',
                'question_number' => 31 + $index,
            ]);

            Answer::create([
                'question_id' => $question->id,
                'answer_text' => $data['answer'],
                'is_correct' => true,
            ]);
        }

        // PART III - True or False (10 items)
        $trueFalseData = [
            ['question' => 'Devices and Printers displays internal RAM.', 'answer' => false],
            ['question' => 'DMA requires processor involvement.', 'answer' => false],
            ['question' => 'Roll Back Driver restores the previous driver version.', 'answer' => true],
            ['question' => 'MMC can create and save administrative consoles.', 'answer' => true],
            ['question' => 'Performance Monitor monitors system performance.', 'answer' => true],
            ['question' => 'Remote Server Administration Tools are for local management only.', 'answer' => false],
            ['question' => 'Server Roles provide specific functions for multiple users.', 'answer' => true],
            ['question' => 'Manual services start automatically at boot.', 'answer' => false],
            ['question' => 'The registry stores hardware and software configuration.', 'answer' => true],
            ['question' => 'HKEY_USERS contains profiles of loaded users.', 'answer' => true],
        ];

        // Seed true/false questions
        foreach ($trueFalseData as $index => $data) {
            $question = Question::create([
                'quiz_id' => $quiz->id,
                'question_text' => $data['question'],
                'question_type' => 'true_false',
                'question_number' => 41 + $index,
            ]);

            Answer::create([
                'question_id' => $question->id,
                'answer_text' => 'True',
                'is_correct' => $data['answer'],
            ]);

            Answer::create([
                'question_id' => $question->id,
                'answer_text' => 'False',
                'is_correct' => !$data['answer'],
            ]);
        }
    }
}
