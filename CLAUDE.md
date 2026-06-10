# CLAUDE.md

<!--
Golden Test: "Would removing this rule cause Claude to make mistakes?"
If not — cut it. Don't restate defaults Claude already knows.
-->

---

# Section A — General Engineering Rules

## 1) Architecture & Separation of Concerns (YOU MUST FOLLOW)
- Follow the project's architecture layer boundaries strictly: presentation → domain → data
- Never bypass layers or mix responsibilities
- UI/presentation layer has ZERO business logic — only rendering, interaction, and state observation
- Business logic lives in the domain layer
- Data access (APIs, databases, storage) lives in the data layer
- Do not introduce new abstractions or patterns without justification

## 2) Shared Code (IMPORTANT)
- Any reusable logic, utility, constant, extension, or helper used in 2+ places goes in `core/`
- Check `core/` before creating new shared code — never duplicate across features

## 3) Error Handling
- Errors flow cleanly across layers — never skip layers
- Handle null, empty, loading, and error states explicitly — no silent failures
- Catch errors at the boundary (data layer), not deep inside business logic

## 4) Change Discipline
- Make the smallest change that solves the problem
- Fix root causes, not symptoms
- Don't refactor unrelated code unless explicitly requested
- Never break existing functionality, APIs, flows, or UX unless explicitly instructed
- Read relevant code before modifying it — state assumptions when unclear

## 5) Dependencies
- Don't add new packages without justification
- Any new package must be: latest stable, well-maintained, production-grade

## 6) Security
- Never hardcode secrets, tokens, or credentials
- Never log sensitive information
- Validate all external and API input
- Proactively flag security risks when spotted

## 7) Testing
- Write tests for domain and data layer logic
- Bug fixes must include a reproducing test
- Tests must be deterministic — no flaky or timing-dependent tests
- One behavior per test case

## 8) Workflow (Mandatory)
- Before creating any new feature → invoke the `/flutter-feature` skill first for scaffolding and architecture reference
- Before marking any task done → run the `/flutter-code-review` skill
- After task approved → use the `@git-expert` agent for branch, commit, and PR output

## 9) Agents — Proactively Suggest (YOU MUST FOLLOW)
You MUST proactively suggest the appropriate agent when the situation matches. Do not wait for the user to ask.

- `@debugger` — When a bug, crash, error, or unexpected behavior is encountered
- `@code-reviewer` — After `/flutter-code-review` passes, ALWAYS suggest running `@code-reviewer` for a deeper independent review before proceeding to PR
- `@test-writer` — When code is changed or added without corresponding tests, or when test coverage is missing
- `@git-expert` — When it's time to create a branch, commit, or PR. Also for merge conflicts, rebases, or any complex git situation

---

# Section B — Laravel / PHP Specific Rules

<!--
Follow PSR-12 coding standards and Laravel conventions.
Rules below only cover things that OVERRIDE defaults or encode project decisions.
-->

## 1) Architecture & MVC
- Follow Laravel's MVC strictly: Controllers handle HTTP, Models handle data, Services handle business logic
- **No business logic in Controllers** — delegate to Service classes under `app/Services/`
- **No raw queries in Controllers** — all data access goes through Eloquent Models or Repositories
- Use Form Request classes for validation — never validate inside controllers manually
- Keep Controllers thin: receive request → call service → return response

## 2) Eloquent & Database
- Use Eloquent relationships — never write raw JOINs unless performance-critical and documented
- Always use migrations for schema changes — never modify the database directly
- Define `$fillable` or `$guarded` on every model — never leave both empty
- Use query scopes for reusable filter logic; never repeat the same `where` chains
- Eager load relationships (`with()`) when looping — never trigger N+1 queries
- Use database transactions for multi-step write operations

## 3) Routing
- Name every route — use named routes in code, never hardcoded URL strings
- Group related routes with `Route::prefix()` and `Route::middleware()`
- API routes live in `routes/api.php`; web routes in `routes/web.php` — never mix them
- Use resource controllers for CRUD — only add extra routes when truly necessary

## 4) Validation
- All validation lives in **Form Request** classes under `app/Http/Requests/`
- Return validation errors as structured JSON for API responses
- Never trust user input — validate and sanitize at the boundary

## 5) Error Handling
- Use Laravel's exception handler (`app/Exceptions/Handler.php`) for centralized error responses
- Throw typed, domain-specific exceptions (e.g., `NotFoundException`, `UnauthorizedException`)
- API responses must use consistent JSON structure: `{ data, message, errors, status }`
- Never expose stack traces or internal details to API consumers in production

## 6) Authentication & Authorization
- Use Laravel **Sanctum** for API token auth or **Breeze/Jetstream** for session auth — no custom auth wheels
- Define all authorization logic in **Policies** or **Gates** — never inline `if ($user->role === ...)` checks in controllers
- Protect routes with middleware (`auth`, `auth:sanctum`) — never check auth manually inside methods

## 7) Dependency Injection & Service Container
- Bind interfaces to implementations in a `ServiceProvider` — never resolve dependencies with `new` inside classes
- Type-hint dependencies in constructors — let the container inject them
- Use `app/Providers/AppServiceProvider.php` or dedicated providers for bindings

## 8) Queues & Jobs
- Push long-running tasks (emails, notifications, data processing) to the queue — never block HTTP requests
- Define jobs in `app/Jobs/` — keep them focused on a single responsibility
- Handle job failures explicitly with `failed()` method or retry policies

## 9) Testing
- Feature tests cover HTTP endpoints end-to-end using `RefreshDatabase`
- Unit tests cover Service and domain logic in isolation
- Use factories for test data — never seed production data in tests
- Assert response structure and status codes, not just `200 OK`
