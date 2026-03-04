// lib/main.dart
// ─────────────────────────────────────────────────────────────────────────────
// PortFolioPH – Application entry point.
//
// Wires together:
//   • MultiProvider (UserProvider, ThemeProvider, NavigationProvider,
//     PortfolioProvider)
//   • GoRouter (created from AppRouter.create, reads UserProvider for guards)
//   • MaterialApp.router (Material 3, light + dark themes from AppTheme)
//
// Sprint 1 flow: main() → App → SplashScreen → DB open → /login | /dashboard
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:go_router/go_router.dart';
import 'package:provider/provider.dart';

import 'package:portfolioph/core/constants/app_constants.dart';
import 'package:portfolioph/core/router/app_router.dart';
import 'package:portfolioph/core/theme/app_theme.dart';
import 'package:portfolioph/presentation/providers/navigation_provider.dart';
import 'package:portfolioph/presentation/providers/portfolio_provider.dart';
import 'package:portfolioph/presentation/providers/theme_provider.dart';
import 'package:portfolioph/presentation/providers/user_provider.dart';

void main() async {
  // Ensure binding is initialised before any plugin calls.
  WidgetsFlutterBinding.ensureInitialized();

  // Lock orientation to portrait for mobile-first UX.
  await SystemChrome.setPreferredOrientations([
    DeviceOrientation.portraitUp,
    DeviceOrientation.portraitDown,
  ]);

  // Initialise theme preference before first paint to avoid flicker.
  final themeProvider = ThemeProvider();
  await themeProvider.load();

  runApp(App(themeProvider: themeProvider));
}

class App extends StatelessWidget {
  final ThemeProvider themeProvider;

  const App({super.key, required this.themeProvider});

  @override
  Widget build(BuildContext context) {
    return MultiProvider(
      providers: [
        // ── Core providers ────────────────────────────────────────────────────
        ChangeNotifierProvider<ThemeProvider>.value(value: themeProvider),
        ChangeNotifierProvider<UserProvider>(create: (_) => UserProvider()),
        ChangeNotifierProvider<NavigationProvider>(
          create: (_) => NavigationProvider(),
        ),
        ChangeNotifierProvider<PortfolioProvider>(
          create: (_) => PortfolioProvider(),
        ),
      ],
      child: const _RouterScope(),
    );
  }
}

/// Separate widget so GoRouter can read UserProvider from context after it is
/// provided by [App] above.
class _RouterScope extends StatefulWidget {
  const _RouterScope();

  @override
  State<_RouterScope> createState() => _RouterScopeState();
}

class _RouterScopeState extends State<_RouterScope> {
  GoRouter? _router;

  @override
  void didChangeDependencies() {
    super.didChangeDependencies();
    // Build the router once, after providers are available in context.
    _router ??= AppRouter.create(context.read<UserProvider>());
  }

  @override
  Widget build(BuildContext context) {
    final themeMode = context.watch<ThemeProvider>().themeMode;
    final router = _router;
    if (router == null) return const SizedBox.shrink();

    return MaterialApp.router(
      title: AppConstants.appName,
      debugShowCheckedModeBanner: false,
      theme: AppTheme.light,
      darkTheme: AppTheme.dark,
      themeMode: themeMode,
      routerConfig: router,
    );
  }
}
