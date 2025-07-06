<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LearningTask;
use App\Models\User;

class LearningTaskSeeder extends Seeder
{
    public function run(): void
    {
        // Get or create a default user
        $user = User::first() ?? User::factory()->create();

        $tasks = [
            // Phase 1: Laravel Fundamentals
            [
                'title' => 'Install Laravel and set up development environment',
                'description' => 'Install Laravel via Composer and configure your development environment',
                'detailed_description' => '1. Install Composer if not already installed\n2. Create new Laravel project: composer create-project laravel/laravel project-name\n3. Configure .env file with database settings\n4. Run php artisan key:generate\n5. Test installation with php artisan serve',
                'phase' => 'fundamentals',
                'category' => 'installation',
                'priority' => 'critical',
                'estimated_hours' => 2,
                'order_in_phase' => 1,
                'is_milestone' => true,
                'resources' => [
                    'https://laravel.com/docs/installation',
                    'https://getcomposer.org/download/'
                ],
                'notes' => 'This is the foundation of your Laravel journey. Make sure everything works before proceeding.'
            ],
            [
                'title' => 'Understand MVC (Model-View-Controller) pattern',
                'description' => 'Learn the MVC architectural pattern that Laravel follows',
                'detailed_description' => 'Study how Laravel implements MVC:\n- Models: Handle data and business logic\n- Views: Present data to users\n- Controllers: Handle user requests and coordinate between models and views',
                'phase' => 'fundamentals',
                'category' => 'controllers',
                'priority' => 'high',
                'estimated_hours' => 3,
                'order_in_phase' => 2,
                'resources' => [
                    'https://laravel.com/docs/architecture-concepts',
                    'https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller'
                ]
            ],
            [
                'title' => 'Learn Laravel directory structure',
                'description' => 'Understand the organization of Laravel project files and folders',
                'detailed_description' => 'Key directories to understand:\n- app/: Application logic\n- config/: Configuration files\n- database/: Migrations and seeders\n- resources/: Views, assets, language files\n- routes/: Route definitions\n- storage/: Logs, cache, uploaded files',
                'phase' => 'fundamentals',
                'category' => 'installation',
                'priority' => 'medium',
                'estimated_hours' => 1,
                'order_in_phase' => 3
            ],
            [
                'title' => 'Create basic routes in routes/web.php',
                'description' => 'Learn how to define routes and handle HTTP requests',
                'detailed_description' => 'Practice creating:\n- GET routes for displaying pages\n- POST routes for form submissions\n- Route parameters\n- Route naming\n- Route groups',
                'phase' => 'fundamentals',
                'category' => 'routing',
                'priority' => 'high',
                'estimated_hours' => 2,
                'order_in_phase' => 4,
                'resources' => [
                    'https://laravel.com/docs/routing'
                ]
            ],
            [
                'title' => 'Create controllers using artisan commands',
                'description' => 'Learn to generate and use controllers to handle application logic',
                'detailed_description' => 'Commands to learn:\n- php artisan make:controller UserController\n- php artisan make:controller PostController --resource\n- Understanding controller methods\n- Return responses from controllers',
                'phase' => 'fundamentals',
                'category' => 'controllers',
                'priority' => 'high',
                'estimated_hours' => 3,
                'order_in_phase' => 5,
                'resources' => [
                    'https://laravel.com/docs/controllers'
                ]
            ],

            // Phase 2: Database & Eloquent ORM
            [
                'title' => 'Configure database and run migrations',
                'description' => 'Set up database connection and understand Laravel migrations',
                'detailed_description' => '1. Configure database in .env file\n2. Create migration: php artisan make:migration create_users_table\n3. Define table structure in migration\n4. Run migrations: php artisan migrate\n5. Rollback migrations: php artisan migrate:rollback',
                'phase' => 'database',
                'category' => 'models',
                'priority' => 'critical',
                'estimated_hours' => 2,
                'order_in_phase' => 1,
                'is_milestone' => true,
                'resources' => [
                    'https://laravel.com/docs/migrations'
                ]
            ],
            [
                'title' => 'Create Eloquent models and define relationships',
                'description' => 'Learn to create models and define relationships between them',
                'detailed_description' => 'Practice creating:\n- Basic models with php artisan make:model\n- One-to-One relationships (hasOne, belongsTo)\n- One-to-Many relationships (hasMany, belongsTo)\n- Many-to-Many relationships (belongsToMany)\n- Model attributes (fillable, hidden, casts)',
                'phase' => 'database',
                'category' => 'models',
                'priority' => 'high',
                'estimated_hours' => 4,
                'order_in_phase' => 2,
                'resources' => [
                    'https://laravel.com/docs/eloquent',
                    'https://laravel.com/docs/eloquent-relationships'
                ]
            ],
            [
                'title' => 'Create and run database seeders',
                'description' => 'Learn to populate your database with sample data',
                'detailed_description' => '1. Create seeder: php artisan make:seeder UserSeeder\n2. Define sample data in seeder\n3. Run specific seeder: php artisan db:seed --class=UserSeeder\n4. Run all seeders: php artisan db:seed\n5. Use factories for generating fake data',
                'phase' => 'database',
                'category' => 'models',
                'priority' => 'medium',
                'estimated_hours' => 2,
                'order_in_phase' => 3,
                'resources' => [
                    'https://laravel.com/docs/seeding'
                ]
            ],

            // Phase 3: Views & Frontend
            [
                'title' => 'Learn Blade syntax and directives',
                'description' => 'Master Laravel\'s templating engine for creating dynamic views',
                'detailed_description' => 'Key concepts to learn:\n- Echoing data: {{ $variable }}\n- Control structures: @if, @foreach, @while\n- Including files: @include\n- Extending layouts: @extends, @section\n- Components: @component\n- Stacks: @stack, @push',
                'phase' => 'frontend',
                'category' => 'views',
                'priority' => 'high',
                'estimated_hours' => 3,
                'order_in_phase' => 1,
                'resources' => [
                    'https://laravel.com/docs/blade'
                ]
            ],
            [
                'title' => 'Create layouts and master templates',
                'description' => 'Build reusable layouts and master templates for consistent UI',
                'detailed_description' => 'Practice creating:\n- Master layout with common elements\n- Extending layouts in child views\n- Passing data to layouts\n- Creating reusable components\n- Using yield and section directives',
                'phase' => 'frontend',
                'category' => 'views',
                'priority' => 'high',
                'estimated_hours' => 3,
                'order_in_phase' => 2
            ],
            [
                'title' => 'Create HTML forms with CSRF protection',
                'description' => 'Build forms and implement Laravel\'s CSRF protection',
                'detailed_description' => 'Learn to create:\n- Form opening and closing tags\n- CSRF token inclusion\n- Input fields and validation\n- File uploads\n- Form helpers and old input',
                'phase' => 'frontend',
                'category' => 'forms',
                'priority' => 'high',
                'estimated_hours' => 2,
                'order_in_phase' => 3,
                'resources' => [
                    'https://laravel.com/docs/forms'
                ]
            ],
            [
                'title' => 'Implement form validation',
                'description' => 'Learn to validate form data using Laravel\'s validation system',
                'detailed_description' => 'Practice implementing:\n- Basic validation rules\n- Custom validation rules\n- Validation error messages\n- Displaying validation errors in views\n- Form request validation classes',
                'phase' => 'frontend',
                'category' => 'forms',
                'priority' => 'high',
                'estimated_hours' => 3,
                'order_in_phase' => 4,
                'resources' => [
                    'https://laravel.com/docs/validation'
                ]
            ],

            // Phase 4: Authentication & Authorization
            [
                'title' => 'Set up Laravel Breeze for authentication',
                'description' => 'Install and configure Laravel Breeze for user authentication',
                'detailed_description' => '1. Install Breeze: composer require laravel/breeze --dev\n2. Install Breeze: php artisan breeze:install\n3. Run migrations: php artisan migrate\n4. Install and build assets: npm install && npm run dev\n5. Customize authentication views',
                'phase' => 'auth',
                'category' => 'authentication',
                'priority' => 'critical',
                'estimated_hours' => 2,
                'order_in_phase' => 1,
                'is_milestone' => true,
                'resources' => [
                    'https://laravel.com/docs/starter-kits#laravel-breeze'
                ]
            ],
            [
                'title' => 'Create policies for model authorization',
                'description' => 'Learn to create and use policies for fine-grained authorization',
                'detailed_description' => 'Practice creating:\n- Generate policy: php artisan make:policy PostPolicy\n- Define authorization methods\n- Register policies in AuthServiceProvider\n- Use policies in controllers and views\n- Policy methods: view, create, update, delete',
                'phase' => 'auth',
                'category' => 'authorization',
                'priority' => 'high',
                'estimated_hours' => 4,
                'order_in_phase' => 2,
                'resources' => [
                    'https://laravel.com/docs/authorization'
                ]
            ],

            // Phase 5: Advanced Features
            [
                'title' => 'Handle file uploads and storage',
                'description' => 'Learn to handle file uploads and manage file storage',
                'detailed_description' => 'Topics to cover:\n- File upload forms\n- File validation\n- Storing files in storage/app\n- Public file storage\n- File URLs and links\n- Image manipulation with Intervention Image',
                'phase' => 'advanced',
                'category' => 'file_uploads',
                'priority' => 'medium',
                'estimated_hours' => 3,
                'order_in_phase' => 1,
                'resources' => [
                    'https://laravel.com/docs/filesystem'
                ]
            ],
            [
                'title' => 'Implement caching strategies',
                'description' => 'Learn to use Laravel\'s caching system to improve performance',
                'detailed_description' => 'Practice implementing:\n- Route caching\n- View caching\n- Query caching\n- Cache drivers (file, redis, database)\n- Cache tags and expiration\n- Cache helpers',
                'phase' => 'advanced',
                'category' => 'caching',
                'priority' => 'medium',
                'estimated_hours' => 3,
                'order_in_phase' => 2,
                'resources' => [
                    'https://laravel.com/docs/cache'
                ]
            ],
            [
                'title' => 'Create and use queues and jobs',
                'description' => 'Learn to handle background processing with queues',
                'detailed_description' => 'Topics to cover:\n- Create job: php artisan make:job ProcessPodcast\n- Queue configuration\n- Job dispatching\n- Queue workers\n- Failed jobs handling\n- Job middleware',
                'phase' => 'advanced',
                'category' => 'queues',
                'priority' => 'medium',
                'estimated_hours' => 4,
                'order_in_phase' => 3,
                'resources' => [
                    'https://laravel.com/docs/queues'
                ]
            ],

            // Phase 6: API Development
            [
                'title' => 'Create RESTful API routes',
                'description' => 'Learn to build RESTful APIs with Laravel',
                'detailed_description' => 'Practice creating:\n- API routes in routes/api.php\n- Resource controllers\n- API authentication with Sanctum\n- API versioning\n- Rate limiting\n- API documentation',
                'phase' => 'api',
                'category' => 'api_development',
                'priority' => 'high',
                'estimated_hours' => 4,
                'order_in_phase' => 1,
                'is_milestone' => true,
                'resources' => [
                    'https://laravel.com/docs/api-resources',
                    'https://laravel.com/docs/sanctum'
                ]
            ],
            [
                'title' => 'Create API resources and collections',
                'description' => 'Learn to transform data for API responses',
                'detailed_description' => 'Practice creating:\n- API resources: php artisan make:resource UserResource\n- API collections\n- Resource transformation\n- Conditional attributes\n- Nested resources',
                'phase' => 'api',
                'category' => 'api_development',
                'priority' => 'medium',
                'estimated_hours' => 3,
                'order_in_phase' => 2,
                'resources' => [
                    'https://laravel.com/docs/api-resources'
                ]
            ],

            // Phase 7: Testing & Deployment
            [
                'title' => 'Write unit tests for models and controllers',
                'description' => 'Learn to write comprehensive tests for your Laravel application',
                'detailed_description' => 'Practice writing:\n- Model tests\n- Controller tests\n- Feature tests\n- Database factories\n- Test assertions and mocking\n- Test coverage',
                'phase' => 'testing',
                'category' => 'testing',
                'priority' => 'high',
                'estimated_hours' => 5,
                'order_in_phase' => 1,
                'is_milestone' => true,
                'resources' => [
                    'https://laravel.com/docs/testing'
                ]
            ],
            [
                'title' => 'Optimize database queries and performance',
                'description' => 'Learn to optimize your application for better performance',
                'detailed_description' => 'Topics to cover:\n- Query optimization\n- Eager loading relationships\n- Database indexing\n- Query caching\n- Performance monitoring\n- Laravel Telescope',
                'phase' => 'testing',
                'category' => 'performance',
                'priority' => 'medium',
                'estimated_hours' => 4,
                'order_in_phase' => 2,
                'resources' => [
                    'https://laravel.com/docs/eloquent#eager-loading'
                ]
            ],
            [
                'title' => 'Deploy Laravel application to production',
                'description' => 'Learn to deploy your Laravel application to a production server',
                'detailed_description' => 'Deployment steps:\n- Server preparation\n- Environment configuration\n- Database setup\n- File permissions\n- SSL certificate setup\n- CI/CD pipeline',
                'phase' => 'testing',
                'category' => 'deployment',
                'priority' => 'high',
                'estimated_hours' => 6,
                'order_in_phase' => 3,
                'is_milestone' => true,
                'resources' => [
                    'https://laravel.com/docs/deployment'
                ]
            ],

            // Phase 8: Security & Best Practices
            [
                'title' => 'Implement security best practices',
                'description' => 'Learn Laravel security features and best practices',
                'detailed_description' => 'Security topics:\n- CSRF protection\n- XSS prevention\n- SQL injection prevention\n- Authentication security\n- Authorization\n- Input validation and sanitization',
                'phase' => 'security',
                'category' => 'security',
                'priority' => 'critical',
                'estimated_hours' => 4,
                'order_in_phase' => 1,
                'is_milestone' => true,
                'resources' => [
                    'https://laravel.com/docs/security'
                ]
            ],
            [
                'title' => 'Follow Laravel coding standards and best practices',
                'description' => 'Learn Laravel coding standards and architectural best practices',
                'detailed_description' => 'Best practices:\n- PSR standards compliance\n- SOLID principles\n- Design patterns\n- Code organization\n- Documentation\n- Code review practices',
                'phase' => 'security',
                'category' => 'best_practices',
                'priority' => 'medium',
                'estimated_hours' => 3,
                'order_in_phase' => 2,
                'resources' => [
                    'https://laravel.com/docs/contributions#coding-style'
                ]
            ],

            // Phase 9: Real-World Projects
            [
                'title' => 'Build a complete blog system',
                'description' => 'Apply all learned concepts to build a full-featured blog',
                'detailed_description' => 'Features to implement:\n- User authentication\n- CRUD operations for posts\n- Comments system\n- Categories and tags\n- Search functionality\n- Admin panel',
                'phase' => 'projects',
                'category' => 'integrations',
                'priority' => 'high',
                'estimated_hours' => 20,
                'order_in_phase' => 1,
                'is_milestone' => true,
                'notes' => 'This project will consolidate all your Laravel knowledge'
            ],
            [
                'title' => 'Create an e-commerce platform',
                'description' => 'Build a comprehensive e-commerce solution',
                'detailed_description' => 'E-commerce features:\n- Product catalog\n- Shopping cart\n- User accounts\n- Order management\n- Payment integration\n- Inventory management',
                'phase' => 'projects',
                'category' => 'integrations',
                'priority' => 'high',
                'estimated_hours' => 30,
                'order_in_phase' => 2,
                'is_milestone' => true,
                'notes' => 'Advanced project to showcase complex Laravel applications'
            ]
        ];

        foreach ($tasks as $taskData) {
            LearningTask::create(array_merge($taskData, [
                'user_id' => $user->id,
                'status' => 'not_started'
            ]));
        }
    }
}
