// lib/presentation/screens/dashboard/dashboard_screen.dart
// ─────────────────────────────────────────────────────────────────────────────
// Dashboard / Home tab – Sprint 1 placeholder.
// TODO (Sprint 3): Replace with real widgets: featured projects, stats cards.
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/material.dart';
import 'package:provider/provider.dart';

import 'package:portfolioph/core/constants/app_constants.dart';
import 'package:portfolioph/presentation/providers/user_provider.dart';
import 'package:portfolioph/presentation/widgets/common/placeholder_tab_body.dart';

class DashboardScreen extends StatelessWidget {
  const DashboardScreen({super.key});

  @override
  Widget build(BuildContext context) {
    final user = context.watch<UserProvider>().currentUser;

    return Scaffold(
      appBar: AppBar(
        title: Text(
          user != null
              ? 'Hello, ${user.fullName ?? user.username}!'
              : AppConstants.appName,
        ),
        actions: [
          IconButton(
            icon: const Icon(Icons.notifications_outlined),
            tooltip: 'Notifications',
            onPressed: () {
              // TODO (Sprint 4): open notifications panel
            },
          ),
        ],
      ),
      body: const PlaceholderTabBody(
        icon: Icons.dashboard_rounded,
        title: 'Dashboard',
        subtitle:
            'Sprint 3 will add featured projects,\nstats cards, and quick actions.',
      ),
    );
  }
}
