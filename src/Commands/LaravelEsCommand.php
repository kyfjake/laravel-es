<?php


namespace LaravelEs\Commands;

use Illuminate\Console\Command;

class LaravelEsCommand extends Command
{
    protected $signature = "laravel-es {action? : publish}";

    public function fire()
    {
        $this->handle();
    }

    public function handle()
    {
        $this->publish();
    }

    public function publish()
    {
        $basePath = base_path();
        $configPath = $basePath . '/config/laravel-es.php';
        $todoList = [
            [
                'from' => realpath(__DIR__ . '/../config/laravel-es.php'),
                'to' => $configPath,
                'mode' => 0644,
            ]
        ];
        if (file_exists($configPath)) {
            $choice = $this->anticipate($configPath . ' already exists, do you want to override it ? Y/N',
                ['Y', 'N'],
                'N'
            );
            if (!$choice || strtoupper($choice) !== 'Y') {
                array_shift($todoList);
            }
        }

        foreach ($todoList as $todo) {
            $toDir = dirname($todo['to']);
            if (!is_dir($toDir)) {
                mkdir($toDir, 0755, true);
            }
            if (file_exists($todo['to'])) {
                unlink($todo['to']);
            }
            $operation = 'Copied';
            if (empty($todo['link'])) {
                copy($todo['from'], $todo['to']);
            } else {
                if (@link($todo['from'], $todo['to'])) {
                    $operation = 'Linked';
                } else {
                    copy($todo['from'], $todo['to']);
                }
            }
            chmod($todo['to'], $todo['mode']);
            $this->line("<info>{$operation} file</info> <comment>[{$todo['from']}]</comment> <info>To</info> <comment>[{$todo['to']}]</comment>");
        }
    }
}