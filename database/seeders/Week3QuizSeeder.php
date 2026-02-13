<?php

namespace Database\Seeders;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Week3QuizSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database with Week 3 Quiz.
     */
    public function run(): void
    {
        // Create Quiz
        $quiz = Quiz::create([
            'title' => 'Week 3 - System Maintenance and Configuration',
            'description' => 'System maintenance, initial configuration, Control Panel, UAC, Remote Assistance, Remote Desktop, and Network Configuration',
            'total_questions' => 30,
        ]);

        // Quiz data with all 30 multiple choice questions
        $quizData = [
            [
                'question' => 'System maintenance is important because it:',
                'answers' => [
                    ['text' => 'Reduces hardware size', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Ensures performance, security, and reliability', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Deletes user accounts', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Removes network access', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Initial Configuration Tasks automatically launch:',
                'answers' => [
                    ['text' => 'During shutdown', 'letter' => 'a', 'correct' => false],
                    ['text' => 'After Windows installation upon first logon', 'letter' => 'b', 'correct' => true],
                    ['text' => 'When formatting disk', 'letter' => 'c', 'correct' => false],
                    ['text' => 'After installing antivirus', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Which is part of Initial Configuration capabilities?',
                'answers' => [
                    ['text' => 'Playing media files', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Configuring network and computer name', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Editing registry manually', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Installing third-party apps only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'The Control Panel is primarily used to:',
                'answers' => [
                    ['text' => 'Play multimedia', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Adjust system settings and manage hardware', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Install games', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Access BIOS', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'The "System and Security" section in Control Panel provides:',
                'answers' => [
                    ['text' => 'Gaming tools', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Centralized oversight for health, updates, and protection', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Printer ink management', 'letter' => 'c', 'correct' => false],
                    ['text' => 'USB formatting', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'User Account Control (UAC) is designed to:',
                'answers' => [
                    ['text' => 'Increase game performance', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Prevent unauthorized system changes', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Remove admin rights', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Disable security prompts', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'UAC asks for:',
                'answers' => [
                    ['text' => 'Internet access', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Administrator permission or password', 'letter' => 'b', 'correct' => true],
                    ['text' => 'BIOS reset', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Network cable', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Which action can a standard user perform without admin rights?',
                'answers' => [
                    ['text' => 'Install server roles', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Modify system registry', 'letter' => 'b', 'correct' => false],
                    ['text' => 'View Windows settings without making changes', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Change domain controller', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'To enable or disable UAC, you must:',
                'answers' => [
                    ['text' => 'Open Task Manager', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Adjust settings in User Accounts → Change UAC settings', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Restart BIOS', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Use Command Prompt only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'After changing UAC settings, you must:',
                'answers' => [
                    ['text' => 'Log off', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Shut down', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Restart system', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Reinstall Windows', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'System Settings allow administrators to:',
                'answers' => [
                    ['text' => 'Play server games', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Change computer name and domain membership', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Format RAM', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Delete OS', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'A workgroup is:',
                'answers' => [
                    ['text' => 'Centralized network controlled by domain controller', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Peer-to-peer network with decentralized accounts', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Cloud-based service', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Firewall configuration', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'A domain:',
                'answers' => [
                    ['text' => 'Has no security boundary', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Is controlled by Windows servers acting as domain controllers', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Is peer-to-peer only', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Does not use Active Directory', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Remote Assistance allows:',
                'answers' => [
                    ['text' => 'Full admin remote access only', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Shared control of mouse during troubleshooting', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Automatic domain joining', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Server backup', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Before using Remote Assistance, you must:',
                'answers' => [
                    ['text' => 'Install it as a Windows feature', 'letter' => 'a', 'correct' => true],
                    ['text' => 'Format hard drive', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Install antivirus', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Disable firewall', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Remote Desktop provides:',
                'answers' => [
                    ['text' => 'Limited text access only', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Full administrative remote access to server desktop', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Printer-only control', 'letter' => 'c', 'correct' => false],
                    ['text' => 'USB configuration', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'By default, Windows Server 2008 R2 supports:',
                'answers' => [
                    ['text' => '1 remote connection', 'letter' => 'a', 'correct' => false],
                    ['text' => '2 remote desktop connections (plus console mode)', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Unlimited connections', 'letter' => 'c', 'correct' => false],
                    ['text' => 'No remote connections', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Network Level Authentication (NLA):',
                'answers' => [
                    ['text' => 'Verifies user after full connection', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Verifies user before full connection', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Disables encryption', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Removes firewall', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Allow connections with NLA is considered:',
                'answers' => [
                    ['text' => 'Less secure', 'letter' => 'a', 'correct' => false],
                    ['text' => 'More secure', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Slower only', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Optional without impact', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Correct date and time are important because:',
                'answers' => [
                    ['text' => 'It improves graphics', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Secure packets may be denied if time is incorrect', 'letter' => 'b', 'correct' => true],
                    ['text' => 'It changes IP address', 'letter' => 'c', 'correct' => false],
                    ['text' => 'It resets domain', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'An IP address:',
                'answers' => [
                    ['text' => 'Identifies the router only', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Uniquely identifies a computer on a network', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Encrypts passwords', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Controls BIOS', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'The default gateway:',
                'answers' => [
                    ['text' => 'Connects the computer to other networks', 'letter' => 'a', 'correct' => true],
                    ['text' => 'Stores passwords', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Manages DNS', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Controls firewall', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'DNS servers are used to:',
                'answers' => [
                    ['text' => 'Assign MAC address', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Convert domain/host names to IP addresses', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Block network', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Manage RAM', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Remote Assistance connection creates:',
                'answers' => [
                    ['text' => 'One-way unencrypted link', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Two-way encrypted connection', 'letter' => 'b', 'correct' => true],
                    ['text' => 'FTP server', 'letter' => 'c', 'correct' => false],
                    ['text' => 'VPN only', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Standard User Shield in UAC:',
                'answers' => [
                    ['text' => 'Allows full admin control', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Requires admin password for standard user actions', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Disables security', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Removes prompts', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Administrative Tools and Computer Management are:',
                'answers' => [
                    ['text' => 'Gaming utilities', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Server management tools', 'letter' => 'b', 'correct' => true],
                    ['text' => 'BIOS firmware', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Printer drivers', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Hardware Management in Control Panel is used for:',
                'answers' => [
                    ['text' => 'Installing themes', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Configuring devices and drivers', 'letter' => 'b', 'correct' => true],
                    ['text' => 'Changing wallpapers', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Deleting user accounts', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Remote Desktop can be enabled under:',
                'answers' => [
                    ['text' => 'Device Manager', 'letter' => 'a', 'correct' => false],
                    ['text' => 'System Properties → Remote tab', 'letter' => 'b', 'correct' => true],
                    ['text' => 'BIOS', 'letter' => 'c', 'correct' => false],
                    ['text' => 'Registry Editor', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Workgroups are best suited for:',
                'answers' => [
                    ['text' => 'Large enterprise networks', 'letter' => 'a', 'correct' => false],
                    ['text' => 'Centralized authentication', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Small peer-to-peer environments', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Cloud infrastructure', 'letter' => 'd', 'correct' => false],
                ]
            ],
            [
                'question' => 'Domains provide:',
                'answers' => [
                    ['text' => 'Decentralized accounts', 'letter' => 'a', 'correct' => false],
                    ['text' => 'No security boundary', 'letter' => 'b', 'correct' => false],
                    ['text' => 'Centralized security and management', 'letter' => 'c', 'correct' => true],
                    ['text' => 'Local-only access', 'letter' => 'd', 'correct' => false],
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
