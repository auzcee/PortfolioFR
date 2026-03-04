// lib/presentation/widgets/common/placeholder_tab_body.dart
// ─────────────────────────────────────────────────────────────────────────────
// Reusable empty-state widget used across Sprint 1 placeholder screens.
// ─────────────────────────────────────────────────────────────────────────────

import 'package:flutter/material.dart';
import 'package:portfolioph/core/constants/app_constants.dart';

class PlaceholderTabBody extends StatelessWidget {
  final IconData icon;
  final String title;
  final String subtitle;

  const PlaceholderTabBody({
    super.key,
    required this.icon,
    required this.title,
    required this.subtitle,
  });

  @override
  Widget build(BuildContext context) {
    return Center(
      child: Padding(
        padding: const EdgeInsets.all(AppConstants.spacingXl),
        child: Column(
          mainAxisAlignment: MainAxisAlignment.center,
          children: [
            Icon(
              icon,
              size: 72,
              color: AppConstants.primaryColor.withValues(alpha: 0.3),
            ),
            const SizedBox(height: AppConstants.spacingMd),
            Text(
              title,
              style: Theme.of(context).textTheme.titleMedium?.copyWith(
                color: AppConstants.primaryColor,
                fontWeight: FontWeight.w700,
              ),
            ),
            const SizedBox(height: AppConstants.spacingSm),
            Text(
              subtitle,
              textAlign: TextAlign.center,
              style: Theme.of(context).textTheme.bodySmall,
            ),
          ],
        ),
      ),
    );
  }
}
